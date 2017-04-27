<?php

    class WAgency extends Agency
    {
        CONST AGENCY_ACTIVE   = 1;
        CONST AGENCY_INACTIVE = 0;

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return WAgency the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        /**
         * @return static[]
         */
        public static function getListAgency()
        {
            $criteria            = new CDbCriteria;
            $criteria->distinct  = TRUE;
            $criteria->condition = 'status=:status';
            $criteria->params    = array(':status' => self::AGENCY_ACTIVE);
            $criteria->order     = 'sort_order, id DESC';
            $results             = self::model()->findAll($criteria);

            return $results;
        }
    }
