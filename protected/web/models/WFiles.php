<?php

    class WFiles extends Files
    {
        const  FILE_ACTIVE   = 1;
        const  FILE_INACTIVE = 0;
        const  TYPE_CONTENT  = 'content';
        const  TYPE_SLIDER   = 'slider';

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
         * @param $type_content
         *
         * @return array|mixed|null
         */
        public static function getListFileByMediaId($media_id, $type_content = NULL)
        {
            $criteria           = new CDbCriteria;
            $criteria->distinct = TRUE;
            if ($type_content && $type_content == self::TYPE_CONTENT) {
                $criteria->condition = 'status=:status AND media_id=:media_id AND extra_info=:extra_info';
                $criteria->params    = array(':status' => self::FILE_ACTIVE, ':extra_info' => self::TYPE_CONTENT, ':media_id' => $media_id);
            } else {
                $criteria->condition = 'status=:status AND media_id=:media_id AND (extra_info=:extra_info OR extra_info ="" OR extra_info IS NULL)';
                $criteria->params    = array(':status' => self::FILE_ACTIVE, ':extra_info' => self::TYPE_SLIDER, ':media_id' => $media_id);
            }

            $criteria->order = 'sort_order, id DESC';
            $results         = self::model()->findAll($criteria);

            return $results;
        }
    }
