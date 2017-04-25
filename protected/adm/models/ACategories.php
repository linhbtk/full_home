<?php

    class ACategories extends Categories
    {
        const  CATEGORY_ACTIVE   = 1;
        const  CATEGORY_INACTIVE = 0;

        public $name;

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('parent_id, sort_order, status', 'numerical', 'integerOnly' => TRUE),
                array('thumbnail, icon', 'length', 'max' => 255),
                array('icon', 'file', 'on'         => 'insert',
                                      'allowEmpty' => TRUE,
                                      'types'      => 'jpg, jpeg, png, gif'
                ),
                array('icon', 'file', 'on'         => 'update_file',
                                      'allowEmpty' => TRUE,
                                      'types'      => 'jpg, jpeg, png, gif',
                ),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, parent_id, thumbnail, icon, sort_order, status', 'safe', 'on' => 'search'),
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
                'id'         => Yii::t('adm/label', 'id'),
                'parent_id'  => Yii::t('adm/label', 'parent_id'),
                'thumbnail'  => Yii::t('adm/label', 'thumbnail'),
                'icon'       => Yii::t('adm/label', 'icon'),
                'sort_order' => Yii::t('adm/label', 'sort_order'),
                'status'     => Yii::t('adm/label', 'status'),
                'name'       => Yii::t('adm/label', 'name'),
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
            $criteria->select = 't.*, cd.name as name';
            $criteria->join   = 'INNER JOIN tbl_categories_detail cd on cd.categories_id=t.id';

            $criteria->compare('t.id', $this->id, TRUE);
            $criteria->compare('t.parent_id', $this->parent_id, TRUE);
            $criteria->compare('t.thumbnail', $this->thumbnail, TRUE);
            $criteria->compare('t.icon', $this->icon, TRUE);
            $criteria->compare('t.sort_order', $this->sort_order);
            $criteria->compare('t.status', $this->status);
            $criteria->compare('cd.name', $this->name, TRUE);

            return new CActiveDataProvider($this, array(
                'criteria'   => $criteria,
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
         * @return ACategories the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        /**
         * @param null $id
         *
         * @return array
         */
        public static function getParentCategories($id = NULL)
        {
            $criteria         = new CDbCriteria();
            $criteria->select = 't.id, cd.name as name';
            $criteria->join   = 'INNER JOIN tbl_categories_detail cd on cd.categories_id=t.id';
            if ($id) {
                $criteria->condition = 't.id != :id AND t.parent_id != :id';
                $criteria->params    = array(':id' => $id);
            }

            $results = CHtml::listData(self::model()->findAll($criteria), 'id', 'name');

            return $results;
        }

        /**
         * @return array
         */
        public static function getAllCategories()
        {
            $criteria         = new CDbCriteria();
            $criteria->select = 't.id, cd.name as name';
            $criteria->join   = 'INNER JOIN tbl_categories_detail cd on cd.categories_id=t.id';

            $results = CHtml::listData(self::model()->findAll($criteria), 'id', 'name');

            return $results;
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
        public function getParentName()
        {
            $model = '';
            if ($this->parent_id) {
                $criteria            = new CDbCriteria();
                $criteria->select    = 'cd.name as name';
                $criteria->join      = 'INNER JOIN tbl_categories_detail cd on cd.categories_id=t.id';
                $criteria->condition = 't.id = :id';
                $criteria->params    = array(':id' => $this->parent_id);
                $model               = self::model()->find($criteria);
            }

            return ($model) ? CHtml::encode($model->name) : '';
        }

        /**
         * @return bool
         */
        public function beforeSave()
        {
            if (empty($this->parent_id)) {
                $this->parent_id = 0;
            }

            return TRUE;
        }
    }
