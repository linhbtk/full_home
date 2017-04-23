<?php

    class WPartners extends Partners
    {
        CONST PARTNER_ACTIVE   = 1;
        CONST PARTNER_INACTIVE = 0;

        /**
         * @return static[]
         */
        public static function getListPartners()
        {
            $criteria            = new CDbCriteria;
            $criteria->distinct  = TRUE;
            $criteria->condition = 'status=:status';
            $criteria->params    = array(':status' => self::PARTNER_ACTIVE);
            $criteria->order     = 'sort_order, id DESC';
            $results             = self::model()->findAll($criteria);

            return $results;
        }
    }
