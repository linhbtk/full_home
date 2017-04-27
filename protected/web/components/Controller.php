<?php

    /**
     * Controller is the customized base controller class.
     * All controller classes for this application should extend from this base class.
     */
    class Controller extends CController
    {
        /**
         * @var string the default layout for the controller view. Defaults to '//layouts/column1',
         * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
         */
        public $layout = '//layouts/column1';
        public $pageTitle = '';
        public $pageKeyword = '';
        public $pageDescription = '';
        public $pageImage = '';

        const VINAPHONE_TELCO = 'VINAPHONE';
        const MOBIFONE_TELCO = 'MOBIFONE';
        const VIETTEL_TELCO = 'VIETTEL';
        const UNKNOWN_TELCO = 'UNKNOWN_TELCO';

        const CONTROLLER_CUSTOMER = 'customer';
        //action do not check redirect to changPassword in CustomerController
        const ACTION_CHANGEPASS = 'changePassword';
        public $theme_url = '';

        public function init()
        {
            parent::init();
            $this->theme_url = Yii::app()->theme->baseUrl;
            /*Fix xss*/
            if (isset($_GET) && count($_GET) > 0) {
                $p = new CHtmlPurifier();
                foreach ($_GET as $k => $v) {
                    $_GET[$k] = $p->purify($v);
                }
            }

            if (isset($_POST) && count($_POST) > 0) {
                $p = new CHtmlPurifier();
                foreach ($_POST as $k => $v) {
                    $_POST[$k] = $p->purify($v);
                }
            }
            /*End Fix xss*/
            Yii::$classMap = array_merge(Yii::$classMap, array(
                'CaptchaExtendedAction'    => Yii::getPathOfAlias('ext.captchaExtended') . DIRECTORY_SEPARATOR . 'CaptchaExtendedAction.php',
                'CaptchaExtendedValidator' => Yii::getPathOfAlias('ext.captchaExtended') . DIRECTORY_SEPARATOR . 'CaptchaExtendedValidator.php'
            ));

            Yii::app()->language = 'vi';

            /**
             * Check user existed
             */
            // current session's data is exists
            if (!isset(Yii::app()->session['session_data']) || empty(Yii::app()->session['session_data'])) {
                Yii::app()->session['session_data'] = new stdClass();
            }

            //------- User's data -------//
            //giả lập Mobile test
            //$_SERVER['HTTP_MSISDN'] = '84919222400';
            //$_SERVER['REMOTE_ADDR'] = '118.70.177.77';

            //detect telco connection
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $clientIP = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $clientIP = $_SERVER['REMOTE_ADDR'];
            }

            $channel_code                                     = IP::detectTelco($clientIP, Yii::app()->params->IP_MAP_3G);
            Yii::app()->session['session_data']->channel_code = strtoupper($channel_code);

            //Yii::app()->session['session_data']->current_msisdn = '84987802175';

            if ($channel_code == self::VIETTEL_TELCO) {
//                ViettelMsisdnDetect::detect();
            }

            //Lấy controller,action hiện tại cho
            $current_url = Yii::app()->urlManager->parseUrl(Yii::app()->request);
            $ary_request = explode('/', $current_url);

            Yii::app()->session['session_data']->controller = isset($ary_request[0]) ? $ary_request[0] : '';
            Yii::app()->session['session_data']->action     = isset($ary_request[1]) ? $ary_request[1] : '';
        }

        /**
         * @var array context menu items. This property will be assigned to {@link CMenu::items}.
         */
        public $menu = array();
        /**
         * @var array the breadcrumbs of the current page. The value of this property will
         * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
         * for more details on how to specify this property.
         */

        public $breadcrumbs = array();

        /**
         * @param CAction $action
         *
         * @return bool
         */
        protected function beforeAction($action)
        {
            return parent::beforeAction($action);
        }

        /**
         * auto login with msisdn
         *
         * @param $current_msisdn
         *
         * @return bool
         */
        public function checkAutoLogin($current_msisdn)
        {
            $customer = WCustomers::model()->find('msisdn=:msisdn', array(':msisdn' => CFunction_MPS::makePhoneNumberStandard($current_msisdn)));
            if ($customer) {
                if (!empty($customer->token_key)) {
                    Yii::app()->request->cookies['need_change_pass'] = new CHttpCookie('need_change_pass', true, array('expire' => time() + 2592000));
                }
                $model_login             = new WLoginForm();
                $model_login->username   = $customer->msisdn;
                $model_login->rememberMe = 1;
                if ($model_login->loginWithMsisdn()) {
                    return true;
                }
            }

            return true;
        }

    }