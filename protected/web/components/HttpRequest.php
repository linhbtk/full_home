<?php

    class HttpRequest extends CHttpRequest
    {
        private $_csrfToken;

        public function getCsrfToken()
        {
            if ($this->_csrfToken === NULL) {
                $session   = Yii::app()->session;
                $csrfToken = $session->itemAt($this->csrfTokenName);
                if ($csrfToken === NULL) {
                    $csrfToken = sha1(uniqid(mt_rand(), TRUE));
                    $session->add($this->csrfTokenName, $csrfToken);
                }
                $this->_csrfToken = $csrfToken;
                //var_dump($csrfToken);
                //exit();
            }

            return $this->_csrfToken;
        }

        public function validateCsrfToken($event)
        {
            //$_REQUEST['refresh'] - ko check CSRF token với captcha refresh
            if ($this->getIsAjaxRequest() && !isset($_REQUEST['ajax']) && !isset($_REQUEST['refresh'])) {
                //var_dump($_REQUEST[$this->csrfTokenName]);
                //exit();
                $session = Yii::app()->session;
                if ($session->contains($this->csrfTokenName) && isset($_REQUEST[$this->csrfTokenName])) {

                    $tokenFromSession = $session->itemAt($this->csrfTokenName);

                    $tokenFromPost = $_REQUEST[$this->csrfTokenName];
                    $valid         = $tokenFromSession === $tokenFromPost;
                } else {
                    $valid = FALSE;
                }
                if (!$valid)
                    throw new CHttpException(400, Yii::t('yii', 'The CSRF token could not be verified.'));
            }
            if ($this->getIsPostRequest()) {
                // only validate POST requests
                $session = Yii::app()->session;
                if ($session->contains($this->csrfTokenName) && isset($_REQUEST[$this->csrfTokenName])) {
                    $tokenFromSession = $session->itemAt($this->csrfTokenName);
                    $tokenFromPost    = $_REQUEST[$this->csrfTokenName];
                    $valid            = $tokenFromSession === $tokenFromPost;
                } else
                    $valid = FALSE;
                if (!$valid)
                    throw new CHttpException(400, Yii::t('yii', 'The CSRF token could not be verified.'));
            }
        }
    }

?>