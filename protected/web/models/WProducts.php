<?php

    class WProducts extends Products
    {
        const  PRODUCT_ACTIVE   = 1;
        const  PRODUCT_INACTIVE = 0;

        public $name;
        public $price;


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
         * @param            $categories_id
         * @param bool|FALSE $dataProvider
         * @param int        $limit
         * @param int        $offset
         *
         * @return CActiveDataProvider|static[]
         */
        public static function getProductsInCategory($categories_id, $dataProvider = FALSE, $limit = 10, $offset = 0)
        {
            $criteria            = new CDbCriteria();
            $criteria->distinct  = TRUE;
            $criteria->select    = 't.*, pd.name as name, pd.price as price';
            $criteria->join      = 'INNER JOIN tbl_product_detail as pd ON pd.product_id = t.id';
            $criteria->condition = 't.status=:status AND t.categories_id=:categories_id';
            $criteria->params    = array(':status' => self::PRODUCT_ACTIVE, ':categories_id' => $categories_id);
            $criteria->limit     = $limit;
            $criteria->offset    = $offset;
            $criteria->order     = 't.id DESC';
            if ($dataProvider) {
                return new CActiveDataProvider(self::model(), array(
                    'criteria'   => $criteria,
                    'sort'       => array('defaultOrder' => 't.id DESC'),
                    'pagination' => array(
                        'pageSize' => $limit,
                    ),
                ));
            } else {
                $results = self::model()->findAll($criteria);

                return $results;
            }
        }
    }
