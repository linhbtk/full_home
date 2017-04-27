<?php

    class WProducts extends Products
    {
        const  PRODUCT_ACTIVE   = 1;
        const  PRODUCT_INACTIVE = 0;

        public $name;
        public $price;
        public $categories_id;


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
        public static function getProductsInCategory($categories_id, $product_id = '', $dataProvider = FALSE, $limit = 8, $offset = 0)
        {
            $criteria           = new CDbCriteria();
            $criteria->distinct = TRUE;
            $criteria->select   = 't.*, pd.name as name, pd.price as price';
            $criteria->join     = 'INNER JOIN tbl_product_detail as pd ON pd.product_id = t.id';
            $criteria->join .= ' INNER JOIN tbl_product_categories_map pcm on pcm.product_id=t.id';
            if ($product_id) {
                $criteria->condition = 't.status=:status AND t.id<>:id AND pcm.categories_id=:categories_id';
                $criteria->params    = array(':status' => self::PRODUCT_ACTIVE, ':id' => $product_id, ':categories_id' => $categories_id);
            } else {
                $criteria->condition = 't.status=:status AND pcm.categories_id=:categories_id';
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
         * @return array|mixed|null
         */
        public static function getProduct($id)
        {
            $criteria            = new CDbCriteria();
            $criteria->select    = 't.*, pcm.categories_id as categories_id';
            $criteria->join      = ' INNER JOIN tbl_product_categories_map pcm on pcm.product_id=t.id';
            $criteria->condition = 't.id =:id';
            $criteria->params    = array(':id' => $id);

            $results = self::model()->find($criteria);

            return $results;
        }

        /**
         * @param $categories_id
         *
         * @return array|bool
         */
        public static function getProductsOfCategories($categories_id)
        {
            $results    = array();
            $categories = WCategories::getCategoriesByParentId($categories_id);
            if ($categories) {
                foreach ($categories as $one) {
                    $temp['category'] = $one;
                    $temp['products'] = self::getProductsInCategory($one->id);
                    if ($temp) {
                        array_push($results, $temp);
                    }
                }
                if ($results) {
                    return $results;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }

        /**
         * search product by keyword
         *
         * @param $keyword
         *
         * @return CActiveDataProvider
         */
        public static function searchProductsByKeywords($keyword, $dataProvider = FALSE)
        {
            $criteria           = new CDbCriteria;
            $criteria->distinct = TRUE;
            $criteria->select   = 't.*, pd.name as name, pd.price as price';
            $criteria->join     = 'INNER JOIN tbl_product_detail as pd ON pd.product_id = t.id';

            $criteria->addSearchCondition('t.code', $keyword, TRUE, 'OR');

            $criteria->addSearchCondition('pd.name', $keyword, TRUE, 'OR');
            $criteria->addSearchCondition('pd.unsign_name', $keyword, TRUE, 'OR');
            $criteria->addSearchCondition('pd.size', $keyword, TRUE, 'OR');
            $criteria->addSearchCondition('pd.material', $keyword, TRUE, 'OR');
            $criteria->addSearchCondition('pd.price', $keyword, TRUE, 'OR');
            $criteria->addSearchCondition('pd.description', $keyword, TRUE, 'OR');

            $criteria->addCondition('t.status = ' . self::PRODUCT_ACTIVE);
            $criteria->order = 'pd.name DESC, t.id DESC';

            if ($dataProvider) {
                return new CActiveDataProvider(self::model(), array(
                    'criteria'   => $criteria,
                    'sort'       => array('defaultOrder' => 'pd.name DESC, t.id DESC'),
                    'pagination' => array(
                        'pageSize' => 1,
                    )
                ));
            } else {
                return self::model()->findAll($criteria);
            }
        }
    }
