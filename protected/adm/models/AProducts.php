<?php

    class AProducts extends Products
    {
        const  PRODUCT_ACTIVE   = 1;
        const  PRODUCT_INACTIVE = 0;
        const  PRODUCT_HOT      = 1;
        const  PRODUCT_UNHOT    = 0;

        public $name;

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('categories_id, code, thumbnail, status', 'required'),
                array('categories_id, sort_order, status, hot', 'numerical', 'integerOnly' => TRUE),
                array('code, thumbnail, sale_off, promotion', 'length', 'max' => 255),
                array('last_update, extra_info', 'safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, categories_id, code, thumbnail, sort_order, last_update, status, extra_info, hot, sale_off, promotion, name', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations()
        {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array();
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                'id'            => Yii::t('adm/label', 'id'),
                'categories_id' => Yii::t('adm/label', 'categories_id'),
                'code'          => Yii::t('adm/label', 'code'),
                'thumbnail'     => Yii::t('adm/label', 'thumbnail'),
                'sort_order'    => Yii::t('adm/label', 'sort_order'),
                'last_update'   => Yii::t('adm/label', 'last_update'),
                'status'        => Yii::t('adm/label', 'status'),
                'extra_info'    => Yii::t('adm/label', 'extra_info'),
                'hot'           => Yii::t('adm/label', 'hot'),
                'sale_off'      => Yii::t('adm/label', 'sale_off'),
                'promotion'     => Yii::t('adm/label', 'promotion'),
                'name'          => Yii::t('adm/label', 'name'),
            );
        }

        /**
         * Retrieves a list of models based on the current search/filter conditions.
         *
         * Typical usecase:
         * - Initialize the model fields with values from filter form.
         * - Execute this method to get CActiveDataProvider instance which will filter
         * models according to data in model fields.
         * - Pass data provider to CGridView, CListView or any similar widget.
         *
         * @return CActiveDataProvider the data provider that can return the models
         * based on the search/filter conditions.
         */
        public function search()
        {
            // @todo Please modify the following code to remove attributes that should not be searched.

            $criteria         = new CDbCriteria;
            $criteria->select = 't.*, pd.name as name';
            $criteria->join   = 'INNER JOIN tbl_product_detail pd on pd.product_id=t.id';

            $criteria->compare('t.id', $this->id, TRUE);
            $criteria->compare('t.categories_id', $this->categories_id);
            $criteria->compare('t.code', $this->code, TRUE);
            $criteria->compare('t.thumbnail', $this->thumbnail, TRUE);
            $criteria->compare('t.sort_order', $this->sort_order);
            $criteria->compare("DATE_FORMAT(t.last_update, '%d/%m/%Y')", $this->last_update);
            $criteria->compare('t.status', $this->status);
            $criteria->compare('t.extra_info', $this->extra_info, TRUE);
            $criteria->compare('t.hot', $this->hot);
            $criteria->compare('t.sale_off', $this->sale_off, TRUE);
            $criteria->compare('t.promotion', $this->promotion, TRUE);
            $criteria->compare('pd.name', $this->name, TRUE);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'sort'       => array(
                    'defaultOrder' => 'id DESC',
                ),
                'pagination' => array(
                    'pageSize' => 30,
                )
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return AProducts the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        /**
         * @return bool
         */
        public function beforeSave()
        {
            $this->last_update = date('Y-m-d H:i:s', time());

            return TRUE;
        }

        /**
         * @param $link
         */
        public function cleanup($link)
        {
            if ($link && file_exists(realpath(Yii::app()->getBasePath() . $link))) {
                unlink(realpath(Yii::app()->getBasePath() . $link));
            }
        }

        /**
         * Get image url
         *
         * @return string
         */
        public function getImageUrl()
        {
            $dir_root = Yii::app()->params->upload_dir_path;

            return CHtml::image($dir_root . $this->thumbnail, '', array("width" => "60", "height" => "60"));
        }

        /**
         * @return string
         */
        public function getCategoriesName()
        {
            $model = '';
            if ($this->categories_id) {
                $criteria            = new CDbCriteria();
                $criteria->select    = 'cd.name as name';
                $criteria->join      = 'INNER JOIN tbl_categories_detail cd on cd.categories_id=t.id';
                $criteria->condition = 't.id = :id';
                $criteria->params    = array(':id' => $this->categories_id);
                $model               = ACategories::model()->find($criteria);
            }

            return ($model) ? CHtml::encode($model->name) : '';
        }

        /**
         * @return array
         */
        public function getAllStatus()
        {
            return array(
                self::PRODUCT_ACTIVE   => Yii::t('adm/label', 'active'),
                self::PRODUCT_INACTIVE => Yii::t('adm/label', 'inactive'),
            );
        }

        /**
         * @param $status
         *
         * @return mixed
         */
        public function getStatusLabel($status)
        {
            $array_status = $this->getAllStatus();

            return $array_status[$status];
        }
    }
