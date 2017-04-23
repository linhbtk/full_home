<?php

    class WBanners extends Banners
    {
        CONST BANNER_ACTIVE   = 1;
        CONST BANNER_INACTIVE = 0;
        CONST TYPE_BANNER     = 'banner';
        CONST TYPE_SLIDER     = 'slider';
        CONST STACK_1         = 1;
        CONST STACK_2         = 2;
        CONST STACK_3         = 3;

        /**
         * @param string $type
         * @param int    $stacks
         *
         * @return static[]
         */
        public static function getListBannersType($type = self::TYPE_SLIDER, $stacks = NULL)
        {
            $criteria           = new CDbCriteria;
            $criteria->distinct = TRUE;
            if ($type == self::TYPE_BANNER) {
                $criteria->condition = 'status=:status AND type=:type';
                $criteria->params    = array(':status' => self::BANNER_ACTIVE, ':type' => $type);
            } else {
                $criteria->condition = 'status=:status AND type=:type AND stacks = :stacks';
                $criteria->params    = array(':status' => self::BANNER_ACTIVE, ':type' => $type, ':stacks' => $stacks);
            }
            $criteria->order = 'sort_order, id DESC';
            $results         = self::model()->findAll($criteria);

            return $results;
        }
    }
