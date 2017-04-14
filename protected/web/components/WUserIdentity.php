<?php

    /**
     * UserIdentity represents the data needed to identity a user.
     * It contains the authentication method that checks if the provided
     * data can identity the user.
     */
    class WUserIdentity extends CUserIdentity
    {
        /**
         * Authenticates a user.
         * The example implementation makes sure if the username and password
         * are both 'demo'.
         * In practical applications, this should be changed to authenticate
         * against some persistent user identity storage (e.g. database).
         *
         * @return boolean whether authentication succeeds.
         */
        public function authenticate()
        {
            if ($this->username != '' && $this->password != '') {

                $api            = new DataAdapter();
                $api->user_name = $this->username;
                $api->password  = $this->password;
                $rs             = $api->login();

                if ($rs) {
                    $this->setState('id', $rs['user_id']);
                    $this->setState('user_id', $rs['user_id']);
                    $this->setState('full_name', $rs['full_name']);
                    $this->setState('username', $rs['user_name']);
                    $this->setState('mobile', $rs['mobile']);
                    $this->setState('avatar', $rs['avatar']);

                    $result = true;
                } else {
                    $result = false;
                }
            } else {
                $result = false;
            }

            return $result;
        }

        /*Add more information: SignUp,LoginFacebookSuccess,LoginGplusSuccess*/
        public function authenticateSetState()
        {
            $criteria            = new CDbCriteria();
            $criteria->condition = '(email=:email OR msisdn=:msisdn)';
            $criteria->params    = array('email' => $this->username, 'msisdn' => $this->username);
            $users               = WCustomers::model()->find($criteria);

            if ($users) {
                $this->setState('user_id', $users->id);
                $this->setState('msisdn', $users->msisdn);
                $this->setState('credit', intval($users->credit));
                return $users;
            } else return false;
        }

        /**
         * auto login with msisdn
         *
         * @return bool|static
         */
        public function authenticateWithMsisdn()
        {
            // login by username
            $criteria            = new CDbCriteria();
            $criteria->condition = '(msisdn=:msisdn)';
            $criteria->params    = array('msisdn' => $this->username);
            $users               = WCustomers::model()->find($criteria);

            if ($users) {
                $this->setState('user_id', $users->id);
                $this->setState('msisdn', $users->msisdn);
                $this->setState('credit', intval($users->credit));
//                $this->setState('avatar', $users->avatar);
//                $this->setState('full_name', $users->first_name. ' '. $users->last_name);
//                $this->setState('gold_point', $users->eBank->gold_point);
//                $this->setState('silver_point', $users->eBank->silver_point);
                return $users;

            } else return false;
        }
    }