<?php

    class Encryption
    {
        protected $_skey;
        protected $_params;
        protected $_signature;
        protected $_public_key;
        protected $_private_key;

        public function __construct()
        {
        }

        public function setSkey($value)
        {
            $this->_skey = $value;
        }

        public function getSkey()
        {
            return $this->_skey;
        }

        public function setPublicKey($value)
        {
            $this->_public_key = $value;
        }

        public function getPublicKey()
        {
            return $this->_public_key;
        }

        public function setPrivateKey($value)
        {
            $this->_private_key = $value;
        }

        public function getPrivateKey()
        {
            return $this->_private_key;
        }

        public function setParams($value)
        {
            $this->_params = $value;
        }

        public function getParams()
        {
            return $this->_params;
        }

        public function setSignature($value)
        {
            $this->_signature = $value;
        }

        public function getSignature()
        {
            return $this->_signature;
        }

        public function safe_b64encode($string)
        {
            $data = base64_encode($string);
            $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);

            return $data;
        }

        public function safe_b64decode($string)
        {
            $data = str_replace(array('-', '_'), array('+', '/'), $string);
            $mod4 = strlen($data) % 4;
            if ($mod4) {
                $data .= substr('====', $mod4);
            }

            return base64_decode($data);
        }

        public function encode($value)
        {
            if (!$value) {
                return FALSE;
            }
            $text      = $value;
            $iv_size   = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
            $iv        = mcrypt_create_iv($iv_size, MCRYPT_RAND);
            $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->getSkey(), $text, MCRYPT_MODE_ECB, $iv);

            return trim($this->safe_b64encode($crypttext));
        }

        public function decode($value)
        {
            if (!$value) {
                return FALSE;
            }
            $crypttext   = $this->safe_b64decode($value);
            $iv_size     = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
            $iv          = mcrypt_create_iv($iv_size, MCRYPT_RAND);
            $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->getSkey(), $crypttext, MCRYPT_MODE_ECB, $iv);

            return trim($decrypttext);
        }

        public function encryptData($value)
        {
            $rs = openssl_public_encrypt($value, $crypttext, $this->_public_key);

            return trim($this->safe_b64encode($crypttext));
        }

        public function decryptData($value)
        {
            openssl_private_decrypt($this->safe_b64decode($value), $newsource, $this->_private_key);

            return trim($newsource);
        }

        public function createSignature($value)
        {
            openssl_sign($value, $this->_signature, $this->_private_key, OPENSSL_ALGO_SHA1);

            return trim($this->safe_b64encode($this->_signature));
        }

        public function verifySignature($value)
        {
            $verify = openssl_verify($value, $this->safe_b64decode($this->_signature), $this->_public_key, OPENSSL_ALGO_SHA1);

            return $verify;
        }

        public function decryptDateViettel($value)
        {
            openssl_public_decrypt($this->safe_b64decode($value), $decrypttext, $this->_public_key);

            return trim($decrypttext);
        }
    }