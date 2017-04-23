<?php

    class AFiles extends Files
    {
        const FILES_ACTIVE   = 1;
        const FILES_INACTIVE = 0;

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('languages_id, file_size, duration, sort_order, part_number, status', 'numerical', 'integerOnly' => TRUE),
                array('media_id', 'length', 'max' => 11),
                array('file_name', 'length', 'max' => 500),
                array('file_ext', 'length', 'max' => 10),
                array('quality', 'length', 'max' => 20),
                array('folder_path, subtitle', 'length', 'max' => 1000),
                array('upload_time, extra_info', 'safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, media_id, languages_id, file_name, file_ext, file_size, duration, quality, folder_path, sort_order, part_number, upload_time, extra_info, subtitle, status', 'safe', 'on' => 'search'),
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
                'id'           => 'ID',
                'media_id'     => 'Media',
                'languages_id' => 'Languages',
                'file_name'    => 'File Name',
                'file_ext'     => 'File Ext',
                'file_size'    => 'File Size',
                'duration'     => 'Duration',
                'quality'      => 'Quality',
                'folder_path'  => 'Folder Path',
                'sort_order'   => 'Sort Order',
                'part_number'  => 'Part Number',
                'upload_time'  => 'Upload Time',
                'extra_info'   => 'Extra Info',
                'subtitle'     => 'Subtitle',
                'status'       => 'Status',
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
         * @param $media_id
         *
         * @return CActiveDataProvider the data provider that can return the models
         * based on the search/filter conditions.
         */
        public function search($media_id = NULL)
        {
            // @todo Please modify the following code to remove attributes that should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare('id', $this->id, TRUE);
            $criteria->compare('languages_id', $this->languages_id);
            $criteria->compare('file_name', $this->file_name, TRUE);
            $criteria->compare('file_ext', $this->file_ext, TRUE);
            $criteria->compare('file_size', $this->file_size);
            $criteria->compare('duration', $this->duration);
            $criteria->compare('quality', $this->quality, TRUE);
            $criteria->compare('folder_path', $this->folder_path, TRUE);
            $criteria->compare('sort_order', $this->sort_order);
            $criteria->compare('part_number', $this->part_number);
            $criteria->compare('upload_time', $this->upload_time, TRUE);
            $criteria->compare('extra_info', $this->extra_info, TRUE);
            $criteria->compare('subtitle', $this->subtitle, TRUE);
            $criteria->compare('status', $this->status);

            if ($media_id != NULL) {
                $criteria->condition = 'media_id=:media_id';
                $criteria->params    = array(':media_id' => $media_id);
            } else {
                $criteria->compare('media_id', $this->media_id, TRUE);
            }

            return new CActiveDataProvider($this, array(
                'criteria'   => $criteria,
                'sort'       => array(
                    'defaultOrder' => 'id',
                ),
                'pagination' => array(
                    'pageSize' => 30,
                ),
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return AFiles the static model class
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
            $this->upload_time = date('Y-m-d H:i:s', time());

            return TRUE;
        }

        /**
         * Get image url
         *
         * @return string
         */
        public function getImageUrl()
        {
            $dir_root = Yii::app()->params->upload_dir_path;

            return CHtml::image($dir_root . $this->folder_path, '', array("width" => "60", "height" => "60"));
        }
    }
