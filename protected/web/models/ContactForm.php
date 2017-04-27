<?php

    class ContactForm extends CFormModel
    {
        public $name;
        public $email;
        public $company;
        public $subject;
        public $body;
        public $verifyCode;

        /**
         * Declares the validation rules.
         */
        public function rules()
        {
            return array(
                // name, email, subject and body are required
                array('name, email, company, subject, body', 'required'),
                array('subject', 'length', 'max' => 1000),
                array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty' => !CCaptcha::checkRequirements()),
                // email has to be a valid email address
                array('email', 'email'),
            );
        }

        /**
         * Declares customized attribute labels.
         * If not declared here, an attribute would have a label that is
         * the same as its name with the first letter in upper case.
         */
        public function attributeLabels()
        {
            return array(
                'name'       => Yii::t('web/full_home', 'name'),
                'email'      => Yii::t('web/full_home', 'email'),
                'company'    => Yii::t('web/full_home', 'company'),
                'subject'    => Yii::t('web/full_home', 'subject'),
                'body'       => Yii::t('web/full_home', 'body'),
                'verifyCode' => Yii::t('web/full_home', 'verifyCode'),
            );
        }

        /**
         * @param        $from
         * @param        $to
         * @param        $subject
         * @param        $short_desc
         * @param string $content
         * @param string $views_layout_path
         *
         * @return bool
         * @throws CException
         * @throws Exception
         * @throws phpmailerException
         */
        public function sendEmail($from, $to, $subject, $short_desc, $content = '', $views_layout_path = 'web.views.layouts')
        {
            $mail = new YiiMailer();
            $mail->setLayoutPath($views_layout_path);
            $mail->setData(array('message' => $content, 'name' => $this->name . '-' . $from, 'company' => $this->company, 'description' => $short_desc));

            $mail->setFrom(Yii::app()->params->sendEmail['username'], $from);
            $mail->setTo($to);
            $mail->setSubject($this->name . ' | ' . $subject);
            $mail->setSmtp(Yii::app()->params->sendEmail['host'], Yii::app()->params->sendEmail['port'], Yii::app()->params->sendEmail['type'], TRUE, Yii::app()->params->sendEmail['username'], Yii::app()->params->sendEmail['password']);
            if ($mail->send()) {

                return TRUE;
            }

            return FALSE;
        }
    }