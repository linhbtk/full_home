<?php

    class WProductDetail extends ProductDetail
    {
        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return WProducts the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        /**
         * @return array relational rules.
         */
        public function relations()
        {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'product' => array(self::BELONGS_TO, 'WProducts', 'product_id'),
            );
        }

        /**
         * @param $product_id
         *
         * @return array|mixed|null
         */
        public static function getProductDetail($product_id)
        {
            $criteria            = new CDbCriteria();
            $criteria->with      = 'product';
            $criteria->condition = 't.product_id =:product_id';
            $criteria->params    = array(':product_id' => $product_id);

            $results = self::model()->find($criteria);

            return $results;
        }
    }
