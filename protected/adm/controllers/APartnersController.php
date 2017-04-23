<?php

    class APartnersController extends AController
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
            $model = new APartners;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['APartners'])) {
                $model->attributes  = $_POST['APartners'];
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

            if (isset($_POST['APartners'])) {
                $model->attributes  = $_POST['APartners'];
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
            $dataProvider = new CActiveDataProvider('APartners');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin()
        {
            $model = new APartners('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['APartners']))
                $model->attributes = $_GET['APartners'];

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
         * @return APartners the loaded model
         * @throws CHttpException
         */
        public function loadModel($id)
        {
            $model = APartners::model()->findByPk($id);
            if ($model === NULL)
                throw new CHttpException(404, 'The requested page does not exist.');

            return $model;
        }

        /**
         * Performs the AJAX validation.
         *
         * @param APartners $model the model to be validated
         */
        protected function performAjaxValidation($model)
        {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'apartners-form') {
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
            $model  = APartners::model()->findByPk($id);
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
    }
