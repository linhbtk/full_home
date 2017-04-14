<?php

    class ABannersController extends AController
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
                'rights', // perform access control for CRUD operations
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
                    'users'   => array('@'),
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions' => array('changeStatus', 'create', 'update'),
                    'users'   => array('admin'),
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
            $model = new ABanners;
            $time  = date("Ymdhis");

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['ABanners'])) {
                $model->attributes  = $_POST['ABanners'];
                $model->img_desktop = str_replace('../', '', $model->img_desktop);
                $model->img_mobile  = str_replace('../', '', $model->img_mobile);
                $model->file_name = 'file_name';
                $model->file_ext = 'jpg';
                if ($model->validate()) {
                    if ($model->save()) {
//                        $this->redirect(array('view', 'id' => $model->id));
                        $this->redirect(Yii::app()->session['userView' . Yii::app()->user->id . 'returnURL']);
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
            $model                 = $this->loadModel($id);
            $model->old_file       = $model->img_desktop;
            $model->old_img_mobile = $model->img_mobile;
            $dir_root              = '/../';

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['ABanners'])) {
                $model->attributes = $_POST['ABanners'];
                $model->img_desktop = str_replace('../', '', $model->img_desktop);
                $model->img_mobile  = str_replace('../', '', $model->img_mobile);
                $model->file_name = 'file_name';
                $model->file_ext = 'jpg';
                if ($model->validate()) {
                    if ($model->save()) {
                        if (!empty($model->old_file) && ($model->old_file != $model->img_desktop) && file_exists(realpath(Yii::app()->getBasePath() . $dir_root . $model->old_file))) {
                            $model->deleteImages($model->old_file);
                        }
                        if (!empty($model->old_img_mobile) && ($model->old_img_mobile != $model->img_mobile) && file_exists(realpath(Yii::app()->getBasePath() . $dir_root . $model->old_img_mobile))) {
                            $model->deleteImages($model->old_img_mobile);
                        }
//                        $this->redirect(array('view', 'id' => $model->id));
                        $this->redirect(Yii::app()->session['userView' . Yii::app()->user->id . 'returnURL']);
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
            $model                 = $this->loadModel($id);
            $model->old_file       = $model->img_desktop;
            $model->old_img_mobile = $model->img_mobile;
            $dir_root              = '/../';

            if ($model->delete()) {
                if (!empty($model->old_file) && file_exists(realpath(Yii::app()->getBasePath() . $dir_root . $model->old_file))) {
                    $model->deleteImages($model->old_file);
                }
                if (!empty($model->old_img_mobile) && file_exists(realpath(Yii::app()->getBasePath() . $dir_root . $model->old_img_mobile))) {
                    $model->deleteImages($model->old_img_mobile);
                }
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
            $dataProvider = new CActiveDataProvider('ABanners');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin()
        {
            Yii::app()->session['userView' . Yii::app()->user->id . 'returnURL'] = Yii::app()->request->Url;

            $model = new ABanners('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['ABanners']))
                $model->attributes = $_GET['ABanners'];

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
         * @return ABanners the loaded model
         * @throws CHttpException
         */
        public function loadModel($id)
        {
            $model = ABanners::model()->findByPk($id);
            if ($model === NULL)
                throw new CHttpException(404, 'The requested page does not exist.');

            return $model;
        }

        /**
         * Performs the AJAX validation.
         *
         * @param ABanners $model the model to be validated
         */
        protected function performAjaxValidation($model)
        {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'abanners-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        /**
         * Thay đổi trạng thái.
         */
        public function actionChangeStatus()
        {
            $result = FALSE;
            $id              = Yii::app()->getRequest()->getParam('id');
            $status          = Yii::app()->getRequest()->getParam('status');
            $model           = $this->loadModel($id);
            $model->scenario = 'changeStatus';
            if ($model) {
                $model->status = $status;
                if ($model->update()) {
                    $result = TRUE;
                    Yii::app()->user->setFlash('success', Yii::t('adm/label', 'alert_success'));
                } else {
                    $result = FALSE;
                    Yii::app()->user->setFlash('error', Yii::t('adm/label', 'alert_fail'));
                }
            }
            echo CJSON::encode($result);
            exit();
        }
    }
