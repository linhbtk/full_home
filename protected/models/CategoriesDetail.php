<?php

    /**
     * This is the model class for table "{{categories_detail}}".
     *
     * The followings are the available columns in table '{{categories_detail}}':
     *
     * @property string  $id
     * @property integer $categories_id
     * @property integer $language_id
     * @property string  $name
     * @property string  $unsign_name
     * @property string  $last_update
     * @property string  $description
     */
    class CategoriesDetail extends CActiveRecord
    {
        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
            return '{{categories_detail}}';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('categories_id, language_id', 'numerical', 'integerOnly' => TRUE),
                array('name, unsign_name', 'length', 'max' => 255),
                array('last_update, description', 'safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, categories_id, language_id, name, unsign_name, last_update, description', 'safe', 'on' => 'search'),
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
                'id'            => 'ID',
                'categories_id' => 'Categories',
                'language_id'   => 'Language',
                'name'          => 'Name',
                'unsign_name'   => 'Unsign Name',
                'last_update'   => 'Last Update',
                'description'   => 'Description',
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
            $criteria->compare('categories_id', $this->categories_id);
            $criteria->compare('language_id', $this->language_id);
            $criteria->compare('name', $this->name, TRUE);
            $criteria->compare('unsign_name', $this->unsign_name, TRUE);
            $criteria->compare('last_update', $this->last_update, TRUE);
            $criteria->compare('description', $this->description, TRUE);

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
         * @return CategoriesDetail the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }
    }
