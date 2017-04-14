<?php

    /**
     * This is the model class for table "{{banners}}".
     *
     * The followings are the available columns in table '{{banners}}':
     *
     * @property string  $id
     * @property string  $title
     * @property string  $file_name
     * @property string  $file_ext
     * @property string  $img_desktop
     * @property string  $img_mobile
     * @property string  $target_link
     * @property string  $content_html
     * @property integer $sort_order
     * @property integer $status
     * @property string  $type
     */
    class ABanners extends Banners
    {
        CONST BANNER_ACTIVE   = 1;
        CONST BANNER_INACTIVE = 0;
        CONST ONE             = 1;
        CONST ZERO            = 0;
        public $old_file;
        public $old_img_mobile;

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('title, status', 'required'),
                array('sort_order, status', 'numerical', 'integerOnly' => TRUE),
//                array('sort_order', 'sort_order_validate', ''),
                array('title', 'length', 'max' => 255),
                array('file_name', 'length', 'max' => 500),
                array('file_ext', 'length', 'max' => 10),
                array('type', 'length', 'max' => 50),
                array('img_desktop, img_mobile, target_link', 'length', 'max' => 1000),
                array('content_html', 'safe'),
//                array('file, file_img_mobile', 'file', 'on'    => 'insert',
//                                                       'types' => 'jpg, jpeg, png, gif',
//                ),
//                array('file, file_img_mobile', 'file', 'on'         => 'update_file',
//                                                       'types'      => 'jpg, jpeg, png, gif',
//                                                       'allowEmpty' => TRUE,
//
//                ),
//                array('sort_order', 'unique', 'message' => 'The order already exists!'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, title, file_name, file_ext, img_desktop, img_mobile, target_link, content_html, sort_order, status, type', 'safe', 'on' => 'search'),
            );
        }

//        public function sort_order_validate($attribute, $params)
//        {
//            if ($params['status'] === self::ZERO)
//                $pattern = '/^(?=.*[a-zA-Z0-9]).{5,}$/';
//            elseif ($params['strength'] === self::ONE)
//                $pattern = '/^(?=.*\d(?=.*\d))(?=.*[a-zA-Z](?=.*[a-zA-Z])).{5,}$/';
//
//            if (!preg_match($pattern, $this->$attribute))
//                $this->addError($attribute, '');
//        }

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
                'id'              => Yii::t('adm/label', 'id'),
                'title'           => 'Tiêu đề',
                'file_name'       => Yii::t('adm/label', 'file_name'),
                'file_ext'        => Yii::t('adm/label', 'file_ext'),
                'img_desktop'     => 'Ảnh đại diện',
                'img_mobile'      => Yii::t('adm/label', 'img_mobile'),
                'target_link'     => 'Đường dẫn',
                'content_html'    => 'Nội dung banner',
                'sort_order'      => 'Thứ tự trong slide',
                'status'          => 'Trạng thái',
                'file'            => Yii::t('adm/label', 'file'),
                'file_img_mobile' => Yii::t('adm/label', 'file_img_mobile'),
                'type'            => 'Loại banner',
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
        public function search($status = NULL)
        {
            // @todo Please modify the following code to remove attributes that should not be searched.

            if (isset($status) && $status != '') {
                $this->status = $status;
            }

            $criteria = new CDbCriteria;

            $criteria->compare('id', $this->id, TRUE);
            $criteria->compare('title', $this->title, TRUE);
            $criteria->compare('file_name', $this->file_name, TRUE);
            $criteria->compare('file_ext', $this->file_ext, TRUE);
            $criteria->compare('img_desktop', $this->img_desktop, TRUE);
            $criteria->compare('img_mobile', $this->img_mobile, TRUE);
            $criteria->compare('target_link', $this->target_link, TRUE);
            $criteria->compare('content_html', $this->content_html, TRUE);
            $criteria->compare('sort_order', $this->sort_order);
            $criteria->compare('status', $this->status);
            $criteria->compare('type', $this->type, TRUE);

            return new CActiveDataProvider($this, array(
                'criteria'   => $criteria,
                'sort'       => array(
                    'defaultOrder' => 'sort_order',
                ),
                'pagination' => array(
                    'pageSize' => 10,
                )
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return Banners the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        /**
         * delete exists
         *
         * @param $image
         */
        public function deleteImages($image)
        {
            $dir_root = '/../';
            if ($image) {
                unlink(realpath(Yii::app()->getBasePath() . $dir_root . $image));
            }
        }

        /**
         * get value status display index file
         *
         * @return string
         */
        public function getStatusLabel()
        {
            return ($this->status == 1) ? 'Active' : 'Inactive';
        }

        /**
         * Get image url
         *
         * @return string
         */
        public function getImageUrl($mages)
        {
            $dir_root = '../';

            return ($mages && file_exists($dir_root . $mages)) ? CHtml::image($dir_root . $mages, $this->title, array("width" => "100px", "height" => "60px", "title" => $this->title)) : CHtml::image(Yii::app()->theme->baseUrl . "/images/no_img.png", "no image", array("width" => "100px", "height" => "60px", "title" => "no image"));
        }

        /**
         * Get image url
         *
         * @return string
         */
        public function getImageMobile()
        {
            $dir_root = '../';

            return ($this->img_mobile && file_exists($dir_root . $this->img_mobile)) ? CHtml::image($dir_root . $this->img_mobile, $this->title, array("width" => "100px", "height" => "60px", "title" => $this->title)) : CHtml::image(Yii::app()->theme->baseUrl . "/images/no_img.png", "no image", array("width" => "100px", "height" => "60px", "title" => "no image"));
        }

        /**
         * @return array
         */
        public function getListCategoriesType()
        {
            return Yii::app()->params->categories_type;
        }

        /**
         * get label type
         *
         * @return string
         */
        public function getCategoriesTypeLabel()
        {
            $type = $this->getListCategoriesType();

            return (isset($type[$this->type])) ? $type[$this->type] : '';
        }

        public function beforeSave()
        {
            $p                  = new CHtmlPurifier();
            $this->title        = $p->purify($this->title);
            $this->target_link  = $p->purify($this->target_link);
            $this->content_html = $p->purify($this->content_html);
            $this->sort_order   = $p->purify($this->sort_order);

            return parent::beforeSave(); // TODO: Change the autogenerated stub
        }
    }
