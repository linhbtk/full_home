<?php

    class AProductsController extends AController
    {
        /**
         * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
         * using two-column layout. See 'protected/views/layouts/column2.php'.
         */
        public  $layout        = '//layouts/column1';
        public  $defaultAction = 'admin';
        private $dir_upload    = 'products';

        /**
         * @return array action filters
         */
        public function filters()
        {
            return array(
//			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
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
                'model'       => $this->loadModel($id),
                'modelDetail' => $this->loadModelDetail($id),
            ));
        }

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionCreate()
        {
            $model       = new AProducts;
            $modelDetail = new AProductDetail();
            $modelFiles  = new AFiles();

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['AProducts']) && isset($_POST['AProductDetail'])) {
                $model->attributes       = $_POST['AProducts'];
                $modelDetail->attributes = $_POST['AProductDetail'];
                if ($model->thumbnail != '') {
                    $model->thumbnail = str_replace(Yii::app()->params->upload_dir_path, '', $model->thumbnail);
                }

                //Choose Cate
                $model->categories_id = (isset($_POST['AProducts']['categories_id'])) ? $_POST['AProducts']['categories_id'] : array();

                $valid_cate = AIOTreeFunction::getValidAry($model->categories_id);

                if ($model->save()) {
                    $modelDetail->product_id = $model->id;
                    if ($modelDetail->save()) {
                        $model->insertCategoriesMap($valid_cate);
                        $this->redirect(array('update', 'id' => $model->id, 'continue' => TRUE));
                    }
                }
            }

            $this->render('create', array(
                'model'       => $model,
                'modelDetail' => $modelDetail,
                'modelFiles'  => $modelFiles,
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
            $continue    = Yii::app()->request->getParam('continue');
            $model       = $this->loadModel($id);
            $modelDetail = $this->loadModelDetail($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            $old_file   = $model->thumbnail;
            $modelFiles = AFiles::model()->findByAttributes(array('media_id' => $id));
            if (!$modelFiles) {
                $modelFiles = new AFiles();
            }

            if (isset($_POST['AProducts']) && isset($_POST['AProductDetail'])) {
                $model->attributes       = $_POST['AProducts'];
                $modelDetail->attributes = $_POST['AProductDetail'];
                $file                    = NULL;
                if ($model->thumbnail != '') {
                    $model->thumbnail = str_replace(Yii::app()->params->upload_dir_path, '', $model->thumbnail);
                }

                if (isset($_POST['AProducts']['categories_id']))
                    $model->categories_id = $_POST['AProducts']['categories_id'];
                else
                    $model->categories_id = array();

                $valid_cate = AIOTreeFunction::getValidAry($model->categories_id);
                if ($model->save()) {
                    //Save Image
                    if ($model->thumbnail != $old_file) {
                        $model->cleanup('../' . Yii::app()->params->upload_dir_path . $old_file);
                    }
                    if ($modelDetail->save()) {
                        //Save Categories Map
                        $model->insertCategoriesMap($valid_cate, 'update');
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            }
            //Get Selected Cate
            $arr_cate_selected = $model->convertSelectedCate($model->product_map);
            $cate_tree         = AIOTreeFunction::getTreeArray($arr_cate_selected);

            $this->render('update', array(
                'model'       => $model,
                'modelDetail' => $modelDetail,
                'modelFiles'  => $modelFiles,
                'cate_tree'   => $cate_tree,
                'continue'    => $continue,
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
            $modelDetail  = $this->loadModelDetail($id);
            $dir_old_file = '../' . Yii::app()->params->upload_dir_path . $model->thumbnail;

            if ($model->delete() && $modelDetail->delete() && file_exists(realpath(Yii::app()->getBasePath() . $dir_old_file))) {
                unlink(realpath(Yii::app()->getBasePath() . $dir_old_file));
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
            $dataProvider = new CActiveDataProvider('AProducts');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin()
        {
            $model = new AProducts('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['AProducts']))
                $model->attributes = $_GET['AProducts'];

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
         * @return AProducts the loaded model
         * @throws CHttpException
         */
        public function loadModel($id)
        {
            $model = AProducts::model()->findByPk($id);
            if ($model === NULL)
                throw new CHttpException(404, 'The requested page does not exist.');

            return $model;
        }

        /**
         * @param $id
         *
         * @return static
         * @throws CHttpException
         */
        public function loadModelDetail($id)
        {
            $model = AProductDetail::model()->find('product_id=:product_id', array(':product_id' => $id));
            if ($model === NULL)
                throw new CHttpException(404, 'The requested page does not exist.');

            return $model;
        }

        /**
         * Performs the AJAX validation.
         *
         * @param AProducts $model the model to be validated
         */
        protected function performAjaxValidation($model)
        {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'aproducts-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        /**
         * Action change status
         */
        public function actionChangeStatus()
        {
            $result = FALSE;
            $id     = Yii::app()->request->getParam('id');
            $status = Yii::app()->request->getParam('status');
            $model  = $this->loadModel($id);
            if ($model) {
                $model->status = $status;
                if ($model->update()) {
                    $result = TRUE;
                    Yii::app()->user->setFlash('success', Yii::t('adm/label', 'change_status_success'));
                } else {
                    $result = FALSE;
                    Yii::app()->user->setFlash('error', Yii::t('adm/label', 'change_status_fail'));
                }
            }
            echo CJSON::encode($result);
            exit();
        }

        /**
         * @throws CDbException
         * @throws CHttpException
         */
        public function actionSetHot()
        {
            $result = FALSE;
            $id     = Yii::app()->request->getParam('id');
            $status = Yii::app()->request->getParam('status');
            $model  = $this->loadModel($id);
            if ($model) {
                $model->hot = $status;
                if ($model->update()) {
                    $result = TRUE;
                    Yii::app()->user->setFlash('success', Yii::t('adm/label', 'change_status_success'));
                } else {
                    $result = FALSE;
                    Yii::app()->user->setFlash('error', Yii::t('adm/label', 'change_status_fail'));
                }
            }
            echo CJSON::encode($result);
            exit();
        }

        /**
         * @param $media_id
         */
        public function actionImages($media_id)
        {
            if (!$media_id) {
                $this->redirect(array('aProducts/admin'));
            }

            $model = $this->loadModel($media_id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['AProducts'])) {
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

                //save model
                $model->thumbnail = str_replace('../uploads/', '', $destinationFolder) . $fileUploadNewName . '.' . $fileUploadInfo['extension'];

                if ($model->save()) {
                    $this->redirect(array('aProducts/update', 'id' => $media_id, 'continue' => TRUE));
                } else {
                    echo 'some error';
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

//            $max_upload_size   = 300 * 1024;//300Kb
            $max_upload_size   = 999 * 1024 * 1024;
            $accept_file_types = 'jpg|jpeg|png|gif';
            $options_arr       = array(
                'script_url'        => Yii::app()->createUrl('aProducts/deleteFile'),
                'upload_dir'        => $upload_dir,
                'upload_url'        => $dir_root . $DS . 'uploads' . $DS . $this->dir_upload . $DS . 'temp' . $DS,
                'max_file_size'     => $max_upload_size,
                'accept_file_types' => '/\.(' . $accept_file_types . ')$/i',
            );
            $upload_handler    = new UploadHandler($options_arr);
        }
    }
