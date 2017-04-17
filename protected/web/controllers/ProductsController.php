<?php

    class ProductsController extends Controller
    {
        public $layout = '/layouts/content_2';

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
            $this->pageTitle = Yii::t('web/full_home', 'product');

            $this->render('index');

        } //end index

        public function actionDetail()
        {
            $this->pageTitle = Yii::t('web/full_home', 'product');

            if ($this->isMobile) {
                $this->render('detail_mobile');
            } else {
                $this->render('detail');
            }

        }
    } //end class