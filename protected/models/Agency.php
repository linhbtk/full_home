<?php

    /**
     * This is the model class for table "{{partners}}".
     *
     * The followings are the available columns in table '{{partners}}':
     *
     * @property string  $id
     * @property string  $title
     * @property string  $folder_path
     * @property string  $address
     * @property string  $phone_number
     * @property string  $target_link
     * @property integer $sort_order
     * @property integer $status
     */
    class Agency extends CActiveRecord
    {
        CONST AGENCY_ACTIVE   = 1;
        CONST AGENCY_INACTIVE = 0;

        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
            return '{{agency}}';
        }

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
                'id'          => 'ID',
                'title'       => 'Title',
                'address'     => 'Address',
                'folder_path' => 'Folder Path',
                'target_link' => 'Target Link',
                'sort_order'  => 'Sort Order',
                'status'      => 'Status',
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
                'criteria' => $criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return Agency the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }
    }
