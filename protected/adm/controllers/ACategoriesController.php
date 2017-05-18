<?php

    class ACategoriesController extends AController
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
            $model       = new ACategories;
            $modelDetail = new ACategoriesDetail();
            $time        = date("Ymdhis");

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['ACategories']) && isset($_POST['ACategoriesDetail'])) {
                $model->attributes       = $_POST['ACategories'];
                $modelDetail->attributes = $_POST['ACategoriesDetail'];

                if (!is_dir(Yii::app()->params->upload_dir_path . Yii::app()->params->dir_categories)) {
                    mkdir(Yii::app()->params->upload_dir_path . Yii::app()->params->dir_categories, 0777, TRUE);
                }

                $uploadedFile = CUploadedFile::getInstance($model, 'icon');
                if (isset($uploadedFile) && $uploadedFile != NULL) {
                    $file_name   = $time . Utils::unsign_string($uploadedFile->name) . '.' . $uploadedFile->extensionName;
                    $model->icon = Yii::app()->params->dir_categories . '/' . $file_name;
                    $uploadedFile->saveAs(realpath(Yii::app()->getBasePath() . '/' . Yii::app()->params->upload_dir_path . Yii::app()->params->dir_categories . '/') . '/' . $file_name);
                }

                if ($model->thumbnail != '') {
                    $model->thumbnail = str_replace(Yii::app()->params->upload_dir_path, '', $model->thumbnail);
                }
                if ($model->save()) {
                    $modelDetail->categories_id = $model->id;
                    if ($modelDetail->save()) {
                        $this->redirect(array('admin'));
                    }
                }
            }

            $this->render('create', array(
                'model'       => $model,
                'modelDetail' => $modelDetail,
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
            $model       = $this->loadModel($id);
            $modelDetail = $this->loadModelDetail($id);
            $time        = date("Ymdhis");

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['ACategories']) && isset($_POST['ACategoriesDetail'])) {
                $_POST['ACategories']['icon'] = $model->icon;
                $model->attributes            = $_POST['ACategories'];
                $modelDetail->attributes      = $_POST['ACategoriesDetail'];
                if (!is_dir(Yii::app()->params->upload_dir_path . Yii::app()->params->dir_categories)) {
                    mkdir(Yii::app()->params->upload_dir_path . Yii::app()->params->dir_categories, 0777, TRUE);
                }

                $uploadedFile = CUploadedFile::getInstance($model, 'icon');
                if (isset($uploadedFile) && $uploadedFile != NULL) {
                    $model->scenario = 'update_file';
                    $file_name       = $time . Utils::unsign_string($uploadedFile->name) . '.' . $uploadedFile->extensionName;
                    $model->icon     = Yii::app()->params->dir_categories . '/' . $file_name;
                    $uploadedFile->saveAs(realpath(Yii::app()->getBasePath() . '/' . Yii::app()->params->upload_dir_path . Yii::app()->params->dir_categories . '/') . '/' . $file_name);
                }

                if ($model->thumbnail != '') {
                    $model->thumbnail = str_replace(Yii::app()->params->upload_dir_path, '', $model->thumbnail);
                }

                if ($model->save()) {
                    $modelDetail->categories_id = $model->id;
                    if ($modelDetail->save()) {
                        $this->redirect(array('admin'));
                    }
                }
            }

            $this->render('update', array(
                'model'       => $model,
                'modelDetail' => $modelDetail,
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
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }

        /**
         * Lists all models.
         */
        public function actionIndex()
        {
            $dataProvider = new CActiveDataProvider('ACategories');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin()
        {
            $model = new ACategories('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['ACategories']))
                $model->attributes = $_GET['ACategories'];

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
         * @return ACategories the loaded model
         * @throws CHttpException
         */
        public function loadModel($id)
        {
            $model = ACategories::model()->findByPk($id);
            if ($model === NULL)
                throw new CHttpException(404, 'The requested page does not exist.');

            return $model;
        }

        /**
         * @param $categories_id
         *
         * @return array|mixed|null
         * @throws CHttpException
         */
        public function loadModelDetail($categories_id)
        {
            $model = ACategoriesDetail::model()->find('categories_id=:categories_id', array('categories_id' => $categories_id));
            if ($model === NULL)
                throw new CHttpException(404, 'The requested page does not exist.');

            return $model;
        }

        /**
         * Performs the AJAX validation.
         *
         * @param ACategories $model the model to be validated
         */
        protected function performAjaxValidation($model)
        {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'acategories-form') {
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
    }