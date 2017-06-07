<?php

    class AAgencyController extends AController
    {
        /**
         * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
         * using two-column layout. See 'protected/views/layouts/column2.php'.
         */
        public $layout        = '//layouts/column1';
        public $defaultAction = 'admin';

        /**
         * @return array action filters
         */
        public function filters()
        {
            return array(
//                'accessControl', // perform access control for CRUD operations
//                'postOnly + delete', // we only allow deletion via POST request
                'rights',
            );
        }

        /**
         * Specifies the access control rules.
         * This method is used by the 'accessControl' filter.
         *
         * @return array access control rules
         */
        public function accessRules()
        {
            return array(
                array('allow',  // allow all users to perform 'index' and 'view' actions
                    'actions' => array('index', 'view'),
                    'users'   => array('*'),
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions' => array('changeStatus', 'create', 'update'),
                    'users'   => array('@'),
                ),
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                    'actions' => array('admin', 'delete'),
                    'users'   => array('admin'),
                ),
                array('deny',  // deny all users
                    'users' => array('*'),
                ),
            );
        }

        /**
         * Displays a particular model.
         *
         * @param integer $id the ID of the model to be displayed
         */
        public function actionView($id)
        {
            $this->render('view', array(
                'model' => $this->loadModel($id),
            ));
        }

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionCreate()
        {
            $model = new AAgency();

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['AAgency'])) {
                $model->attributes  = $_POST['AAgency'];
                $model->folder_path = str_replace(Yii::app()->params->upload_dir_path, '', $model->folder_path);
                if ($model->validate()) {
                    if ($model->save()) {
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            }

            $this->render('create', array(
                'model' => $model,
            ));
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         *
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate($id)
        {
            $model           = $this->loadModel($id);
            $model->old_file = $model->folder_path;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['AAgency'])) {
                $model->attributes  = $_POST['AAgency'];
                $model->folder_path = str_replace(Yii::app()->params->upload_dir_path, '', $model->folder_path);
                if ($model->validate()) {
                    if ($model->save()) {
                        $dir_old_file = '/' . Yii::app()->params->upload_dir_path . $model->old_file;
                        if (!empty($model->old_file) && ($model->old_file != $model->folder_path) && file_exists(realpath(Yii::app()->getBasePath() . $dir_old_file))) {
                            $model->cleanup($dir_old_file);
                        }
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            }

            $this->render('update', array(
                'model' => $model,
            ));
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         *
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete($id)
        {
            $model           = $this->loadModel($id);
            $model->old_file = $model->folder_path;
            $dir_old_file    = '/' . Yii::app()->params->upload_dir_path . $model->old_file;
            $this->loadModel($id)->delete();
            if (!empty($model->old_file) && file_exists(realpath(Yii::app()->getBasePath() . $dir_old_file))) {
                $model->cleanup($dir_old_file);
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }

        /**
         * Lists all models.
         */
        public function actionIndex()
        {
            $dataProvider = new CActiveDataProvider('AAgency');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin()
        {
            $model = new AAgency('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['AAgency']))
                $model->attributes = $_GET['AAgency'];

            $this->render('admin', array(
                'model' => $model,
            ));
        }

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         *
         * @param integer $id the ID of the model to be loaded
         *
         * @return AAgency the loaded model
         * @throws CHttpException
         */
        public function loadModel($id)
        {
            $model = AAgency::model()->findByPk($id);
            if ($model === NULL)
                throw new CHttpException(404, 'The requested page does not exist.');

            return $model;
        }

        /**
         * Performs the AJAX validation.
         *
         * @param AAgency $model the model to be validated
         */
        protected function performAjaxValidation($model)
        {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'aagency-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        /**
         * Action change status
         */
        public function actionChangeStatus()
        {
            $id     = Yii::app()->getRequest()->getParam('id');
            $status = Yii::app()->getRequest()->getParam('status');
            $model  = AAgency::model()->findByPk($id);
            $result = array('status' => FALSE, 'msg' => '');
            if ($model) {
                $model->status = $status;
                if ($model->update()) {
                    $result = array(
                        'status' => TRUE,
                        'msg'    => Yii::t('adm/label', 'alert_success')
                    );
                } else {
                    $result = array(
                        'status' => FALSE,
                        'msg'    => Yii::t('adm/label', 'alert_fail')
                    );
                }
            }
            echo CJSON::encode($result);
            exit();
        }

        /**
         * action upload image
         */
        public function actionImages()
        {
            $dir_upload = Yii::app()->params->upload_dir_path . 'agency';
            $time       = date("Ymdhis");
            $DS         = DIRECTORY_SEPARATOR;
            if (isset($_POST['tempFileName']) && $_POST['tempFileName'] != '') {
                // file temporary
                $fileTemporary = $_POST['tempFileName'];
                // temporary folder
                $temporaryFolder = $dir_upload . '/temp/';
                if (!file_exists($temporaryFolder)) {
                    mkdir($temporaryFolder, 0777, TRUE);
                }
                // get upload file info
                $fileUploadInfo = pathinfo($fileTemporary);


                $fileUploadNewName = $fileUploadInfo['filename'] . '-' . time();

                // init folder contain file
                $destinationFolder = $dir_upload . $DS . $time . $DS;

                // check and create folder;
                if (!file_exists($destinationFolder)) {
                    mkdir($destinationFolder, 0777, TRUE);
                    mkdir($destinationFolder . 'images/', 0777, TRUE);
                }

                // folder destination
                $destinationFolder .= 'images/';

                // copy temporary file to image file folder and delete in temporary folder
                copy($temporaryFolder . $fileTemporary, $destinationFolder . $fileUploadNewName . '.' . $fileUploadInfo['extension']);
                unlink($temporaryFolder . $fileTemporary);

                //save model
                $file_name = $destinationFolder . $fileUploadNewName . '.' . $fileUploadInfo['extension'];
                echo CJSON::encode(array(
                    'status'    => TRUE,
                    'file_name' => $file_name,
                    'msg'       => '',
                ));
            } else {
                echo CJSON::encode(array(
                    'status'    => FALSE,
                    'file_name' => '',
                    'msg'       => 'Vui lòng chọn file để upload',
                ));
            }

            exit();
        }

        /**
         * Receive book file, upload via ajax
         *
         * @throws CException if uploading is failure
         */
        public function actionUpload()
        {
            $dir_upload = 'agency';
            Yii::import('ext.UploadHandler.UploadHandler');

            $dir_root = dirname(Yii::app()->request->scriptFile);
            $dir_root = str_replace('adm', '', $dir_root);
            $DS       = DIRECTORY_SEPARATOR;

            $upload_dir = $dir_root . $DS . 'uploads' . $DS . $dir_upload . $DS . 'temp' . $DS;
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, TRUE);
            }

            $max_upload_size   = 999 * 1024 * 1024;
            $accept_file_types = 'jpg|jpeg|png|gif';
            $options_arr       = array(
                'script_url'        => Yii::app()->createUrl('aAgency/deleteFile'),
                'upload_dir'        => $upload_dir,
                'upload_url'        => $dir_root . $DS . 'uploads' . $DS . $dir_upload . $DS . 'temp' . $DS,
                'max_file_size'     => $max_upload_size,
                'accept_file_types' => '/\.(' . $accept_file_types . ')$/i',
            );
            $upload_handler    = new UploadHandler($options_arr);
        }
    }
