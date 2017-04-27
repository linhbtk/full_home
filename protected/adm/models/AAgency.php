<?php

    class AAgency extends Agency
    {
        CONST AGENCY_ACTIVE   = 1;
        CONST AGENCY_INACTIVE = 0;

        public $old_file;

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('title, address, folder_path, status', 'required'),
                array('sort_order, status', 'numerical', 'integerOnly' => TRUE),
                array('title, folder_path', 'length', 'max' => 255),
                array('phone_number', 'length', 'max' => 255),
                array('target_link', 'length', 'max' => 1000),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, title, address, phone_number, folder_path, target_link, sort_order, status', 'safe', 'on' => 'search'),
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
                'id'           => Yii::t('adm/label', 'id'),
                'title'        => Yii::t('adm/label', 'title'),
                'address'      => Yii::t('adm/label', 'address'),
                'phone_number' => Yii::t('adm/label', 'phone_number'),
                'folder_path'  => Yii::t('adm/label', 'folder_path'),
                'target_link'  => Yii::t('adm/label', 'target_link'),
                'sort_order'   => Yii::t('adm/label', 'sort_order'),
                'status'       => Yii::t('adm/label', 'status'),
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

            $criteria = new CDbCriteria;

            $criteria->compare('id', $this->id, TRUE);
            $criteria->compare('title', $this->title, TRUE);
            $criteria->compare('address', $this->address, TRUE);
            $criteria->compare('phone_number', $this->phone_number, TRUE);
            $criteria->compare('folder_path', $this->folder_path, TRUE);
            $criteria->compare('target_link', $this->target_link, TRUE);
            $criteria->compare('sort_order', $this->sort_order);
            $criteria->compare('status', $this->status);

            return new CActiveDataProvider($this, array(
                'criteria'   => $criteria,
                'sort'       => array(
                    'defaultOrder' => 'sort_order, id DESC',
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
         * @return AAgency the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        /**
         * @param $url_image
         */
        public function cleanup($url_image)
        {
            if ($url_image) {
                unlink(realpath(Yii::app()->getBasePath() . $url_image));
            }
        }

        /**
         * @param $images
         *
         * @return string
         */
        public function getImageUrl($images)
        {
            $dir_root = Yii::app()->params->upload_dir_path;

            return CHtml::image($dir_root . $images, $this->title, array("width" => "100px", "height" => "60px", "title" => $this->title));
        }

        /**
         * get value status display index file
         *
         * @return string
         */
        public function getStatusLabel()
        {
            return ($this->status == 1) ? Yii::t('adm/label', 'active') : Yii::t('adm/label', 'inactive');
        }
    }
