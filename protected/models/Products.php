<?php

    /**
     * This is the model class for table "{{products}}".
     *
     * The followings are the available columns in table '{{products}}':
     *
     * @property string  $id
     * @property integer $categories_id
     * @property string  $code
     * @property string  $thumbnail
     * @property integer $sort_order
     * @property string  $last_update
     * @property integer $status
     * @property string  $extra_info
     * @property integer $hot
     * @property string  $sale_off
     * @property string  $promotion
     */
    class Products extends CActiveRecord
    {
        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
            return '{{products}}';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('categories_id, sort_order, status, hot', 'numerical', 'integerOnly' => TRUE),
                array('code, thumbnail, sale_off, promotion', 'length', 'max' => 255),
                array('last_update, extra_info', 'safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, categories_id, code, thumbnail, sort_order, last_update, status, extra_info, hot, sale_off, promotion', 'safe', 'on' => 'search'),
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
                'code'          => 'Code',
                'thumbnail'     => 'Thumbnail',
                'sort_order'    => 'Sort Order',
                'last_update'   => 'Last Update',
                'status'        => 'Status',
                'extra_info'    => 'Extra Info',
                'hot'           => 'Hot',
                'sale_off'      => 'Sale Off',
                'promotion'     => 'Promotion',
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
            $criteria->compare('code', $this->code, TRUE);
            $criteria->compare('thumbnail', $this->thumbnail, TRUE);
            $criteria->compare('sort_order', $this->sort_order);
            $criteria->compare('last_update', $this->last_update, TRUE);
            $criteria->compare('status', $this->status);
            $criteria->compare('extra_info', $this->extra_info, TRUE);
            $criteria->compare('hot', $this->hot);
            $criteria->compare('sale_off', $this->sale_off, TRUE);
            $criteria->compare('promotion', $this->promotion, TRUE);

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
         * @return Products the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }
    }
