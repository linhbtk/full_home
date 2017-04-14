<?php

    class SiteController extends Controller
    {
        public $layout = '/layouts/content_1';

        public $isMobile = FALSE;

        public function init()
        {
            parent::init();
            // mobile detect
            $detect         = new MyMobileDetect();
            $this->isMobile = $detect->isMobile();
            if ($detect->isMobile()) {
                $this->layout = '/layouts/main_mobile';
            }
        }

        /**
         * Default action
         */
        public function actionIndex()
        {
            $this->pageTitle = Yii::t('web/full_home', 'homepage');

            $this->render('index');

        } //end index

        public function actionCategories()
        {
            $this->layout    = '/layouts/content_2';
            $this->pageTitle = Yii::t('web/full_home', 'product');

            $this->render('categories');

        }

        public function actionProductDetail()
        {
            $this->layout    = '/layouts/content_2';
            $this->pageTitle = Yii::t('web/full_home', 'product');

            $this->render('product_detail');

        }
    } //end class