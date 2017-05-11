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

        public function actions()
        {
            // return external action classes, e.g.:
            return array(
                // captcha action renders the CAPTCHA image displayed on the contact page
                'captcha' => array(
                    'class'        => 'CaptchaExtendedAction',
                    'density'      => 0,
                    'lines'        => 0,
                    'fillSections' => 0,
                    //'backColor'=>0xFFFFFF,
                ),
            );
        }

        /**
         * This is the action to handle external exceptions.
         */
        public function actionError()
        {
            $this->layout = '/layouts/content_2';
            if ($this->isMobile) {
                $this->layout = '/layouts/main_mobile';
            }
            if ($error = Yii::app()->errorHandler->error) {
                if (Yii::app()->request->isAjaxRequest) {
                    echo $error['message'];
                } else {
                    $this->render('error', $error);
                }
            }
        }

        /**
         * Default action
         */
        public function actionIndex()
        {
            $this->pageTitle = Yii::t('web/full_home', 'homepage');
            $partners        = WPartners::getListPartners();

            $this->render('index', array(
                'partners' => $partners
            ));

        } //end index

        /**
         * action About us
         */
        public function actionAbout()
        {
            $this->layout = '/layouts/content_2';
            if ($this->isMobile) {
                $this->layout = '/layouts/main_mobile';
            }
            $this->pageTitle = Yii::t('web/full_home', 'about');

            $this->render('about');
        }

        /**
         * action Agency
         */
        public function actionAgency()
        {
            $this->layout = '/layouts/content_2';
            if ($this->isMobile) {
                $this->layout = '/layouts/main_mobile';
            }
            $this->pageTitle = Yii::t('web/full_home', 'agency');
            $agency          = WAgency::getListAgency();

            $this->render('agency', array(
                'agency' => $agency
            ));
        }

        /**
         * action Contact
         */
        public function actionContact()
        {
            $this->layout = '/layouts/content_2';
            if ($this->isMobile) {
                $this->layout = '/layouts/main_mobile';
            }
            $this->pageTitle = Yii::t('web/full_home', 'contact');

            $model = new ContactForm();
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'contact-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if (isset($_POST['ContactForm'])) {
                $model->attributes = $_POST['ContactForm'];
                if ($model->validate()) {
                    if ($model->sendEmail($model->email, Yii::app()->params->sendEmail['username'], $model->subject, $model->subject, $model->body)) {
                        Yii::app()->user->setFlash('success', Yii::t('web/full_home', 'contact_success'));
                        $this->refresh();
                    } else {
                        Yii::app()->user->setFlash('danger', Yii::t('web/full_home', 'contact_fail'));
                        $this->refresh();
                    }
                }
            }
            $this->render('contact', array('model' => $model));
        }
    } //end class