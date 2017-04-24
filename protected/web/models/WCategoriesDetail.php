<?php

    class WCategoriesDetail extends CategoriesDetail
    {
        /**
         * @return array relational rules.
         */
        public function relations()
        {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'category' => array(self::BELONGS_TO, 'WCategories', 'categories_id'),
            );
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return WCategoriesDetail the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        /**
         * @param $categories_id
         *
         * @return array|mixed|null
         */
        public static function getCategoryDetail($categories_id)
        {
            $criteria            = new CDbCriteria();
            $criteria->with      = 'category';
            $criteria->condition = 't.categories_id =:categories_id';
            $criteria->params    = array(':categories_id' => $categories_id);

            $results = self::model()->find($criteria);

            return $results;
        }
    }
