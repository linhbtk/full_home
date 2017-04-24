<?php

    class WFiles extends Files
    {
        const  FILE_ACTIVE   = 1;
        const  FILE_INACTIVE = 0;


        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return WFiles the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        /**
         * @param $media_id
         *
         * @return array|mixed|null
         */
        public static function getListFileByMediaId($media_id)
        {
            $criteria            = new CDbCriteria;
            $criteria->distinct  = TRUE;
            $criteria->condition = 'status=:status AND media_id=:media_id';
            $criteria->params    = array(':status' => self::FILE_ACTIVE, ':media_id' => $media_id);
            $criteria->order     = 'sort_order, id DESC';
            $results             = self::model()->findAll($criteria);

            return $results;
        }
    }
