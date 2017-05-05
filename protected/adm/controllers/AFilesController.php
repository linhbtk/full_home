<?php

    class AFilesController extends AController
    {
        private $dir_upload = 'products';
        /**
         * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
         * using two-column layout. See 'protected/views/layouts/column2.php'.
         */
        public $layout = '//layouts/column2';

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
                    'actions' => array('create', 'update'),
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
            $model = new AFiles;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['AFiles'])) {
                $model->attributes = $_POST['AFiles'];
                if ($model->save())
                    $this->redirect(array('view', 'id' => $model->id));
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
            $model = $this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['AFiles'])) {
                $model->attributes = $_POST['AFiles'];
                if ($model->save())
                    $this->redirect(array('view', 'id' => $model->id));
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
            $model        = $this->loadModel($id);
            $media_id     = $model->media_id;
            $dir_old_file = Yii::app()->params->upload_dir_path . $model->folder_path;
            if ($model->delete() && file_exists(realpath(Yii::app()->getBasePath() . $dir_old_file))) {
                unlink(realpath(Yii::app()->getBasePath() . $dir_old_file));
            }

            $this->redirect(array('aProducts/update', 'id' => $media_id, 'continue' => TRUE));
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//            if (!isset($_GET['ajax']))
//                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }

        /**
         * Lists all models.
         */
        public function actionIndex()
        {
            $dataProvider = new CActiveDataProvider('AFiles');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin()
        {
            $model = new AFiles('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['AFiles']))
                $model->attributes = $_GET['AFiles'];

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
         * @return AFiles the loaded model
         * @throws CHttpException
         */
        public function loadModel($id)
        {
            $model = AFiles::model()->findByPk($id);
            if ($model === NULL)
                throw new CHttpException(404, 'The requested page does not exist.');

            return $model;
        }

        /**
         * Performs the AJAX validation.
         *
         * @param AFiles $model the model to be validated
         */
        protected function performAjaxValidation($model)
        {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'afiles-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        /**
         * @throws CHttpException
         */
        public function actionEditableSortOrder()
        {
            if (isset($_POST['name']) && isset($_POST['value']) && isset($_POST['pk']) && $_POST['name'] == 'sort_order') {
                $model             = $this->loadModel($_POST['pk']);
                $model->sort_order = $_POST['value'];
                $model->save();
            }
        }

        /**
         * @param $media_id
         *
         * @throws CHttpException
         */
        public function actionImages($media_id)
        {
            if (!$media_id) {
                $this->redirect(array('aProducts/admin'));
            }

            $modelFiles = new AFiles();

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['AFiles'])) {
                // sync model attribute with POST
                $modelFiles->attributes = $_POST['AFiles'];
                // file temporary
                $fileTemporary = $_POST['tempFileName'];
                if (!isset($_POST['tempFileName']) || $_POST['tempFileName'] == '') {
                    Yii::app()->user->setFlash('error', 'Hãy chọn file để upload.');
                    $this->redirect(array('aProducts/update', 'id' => $media_id, 'continue' => TRUE));
                }

                // temporary folder
                $temporaryFolder = '../uploads/products/temp/';
                if (!file_exists($temporaryFolder)) {
                    mkdir($temporaryFolder, 0777, TRUE);
                }
                // get upload file info
                $fileUploadInfo = pathinfo($fileTemporary);

                $check = FALSE;
                if ($check) {
                    // delete temporary file
                    unlink($temporaryFolder . $fileTemporary);
                    // notify
                    Yii::app()->user->setFlash('error', 'Extension is existed. Please choose an other.');
                    $this->redirect(array('aProducts/update', 'id' => $media_id, 'continue' => TRUE));
                } else {
                    $fileUploadNewName = $fileUploadInfo['filename'] . '-' . time();

                    // init folder contain file for this book
                    $destinationFolder = '../uploads/products/' . $media_id . '/';

                    // check and create folder;
                    if (!file_exists($destinationFolder)) {
                        mkdir($destinationFolder, 0777, TRUE);
                        mkdir($destinationFolder . 'images/', 0777, TRUE);
                    }

                    // folder destination
                    $destinationFolder .= 'images/';

                    // copy temporary file to book file folder and delete in temporary folder
                    copy($temporaryFolder . $fileTemporary, $destinationFolder . $fileUploadNewName . '.' . $fileUploadInfo['extension']);
                    unlink($temporaryFolder . $fileTemporary);

                    // init model info
                    $modelFiles->media_id    = $media_id;
                    $modelFiles->folder_path = str_replace('../uploads/', '', $destinationFolder) . $fileUploadNewName . '.' . $fileUploadInfo['extension'];
                    $modelFiles->file_ext    = $fileUploadInfo['extension'];
                    $modelFiles->file_name   = $fileUploadNewName;
                    $modelFiles->file_size   = filesize($destinationFolder . $fileUploadNewName . '.' . $fileUploadInfo['extension']);
                    $modelFiles->upload_time = date('Y-m-d H:i:s');
                    $modelFiles->status      = AFiles::FILES_ACTIVE;

                    if ($modelFiles->save()) {
                        $this->redirect(array('aProducts/update', 'id' => $media_id, 'continue' => TRUE));
                    } else {
                        echo 'some error';
                    }
                }
            }
        }

        /**
         * Receive book file, upload via ajax
         *
         * @throws CException if uploading is failure
         */
        public function actionUpload()
        {
            Yii::import('ext.UploadHandler.UploadHandler');

            $dir_root = dirname(Yii::app()->request->scriptFile);
            $dir_root = str_replace('adm', '', $dir_root);
            $DS       = DIRECTORY_SEPARATOR;

            $upload_dir = $dir_root . $DS . 'uploads' . $DS . $this->dir_upload . $DS . 'temp' . $DS;
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, TRUE);
            }

            $max_upload_size   = 300 * 1024;//300Kb
            $accept_file_types = 'jpg|jpeg|png|gif';
            $options_arr       = array(
                'script_url'        => Yii::app()->createUrl('aFiles/deleteFile'),
                'upload_dir'        => $upload_dir,
                'upload_url'        => $dir_root . $DS . 'uploads' . $DS . $this->dir_upload . $DS . 'temp' . $DS,
                'max_file_size'     => $max_upload_size,
                'accept_file_types' => '/\.(' . $accept_file_types . ')$/i',
            );
            $upload_handler    = new UploadHandler($options_arr);
        }
    }
