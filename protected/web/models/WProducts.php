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
         * @param            $product_id
         * @param bool|FALSE $dataProvider
         * @param int        $limit
         * @param int        $offset
         *
         * @return CActiveDataProvider|static[]
         */
        public static function getProductsInCategory($categories_id, $product_id = '', $dataProvider = FALSE, $limit = 10, $offset = 0)
        {
            $criteria           = new CDbCriteria();
            $criteria->distinct = TRUE;
            $criteria->select   = 't.*, pd.name as name, pd.price as price';
            $criteria->join     = 'INNER JOIN tbl_product_detail as pd ON pd.product_id = t.id';
            if ($product_id) {
                $criteria->condition = 't.status=:status AND t.id<>:id AND t.categories_id=:categories_id';
                $criteria->params    = array(':status' => self::PRODUCT_ACTIVE, ':id' => $product_id, ':categories_id' => $categories_id);
            } else {
                $criteria->condition = 't.status=:status AND t.categories_id=:categories_id';
                $criteria->params    = array(':status' => self::PRODUCT_ACTIVE, ':categories_id' => $categories_id);
            }
            $criteria->limit  = $limit;
            $criteria->offset = $offset;
            $criteria->order  = 't.id DESC';
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

        /**
         * @param $id
         *
         * @return static
         */
        public static function getProductDetail($id)
        {
            $criteria            = new CDbCriteria();
            $criteria->select    = 't.*, pd.*';
            $criteria->join      = 'INNER JOIN tbl_product_detail pd on pd.product_id=t.id';
            $criteria->condition = 't.id =:id';
            $criteria->params    = array(':id' => $id);

            $results = self::model()->find($criteria);

            return $results;
        }
    }
