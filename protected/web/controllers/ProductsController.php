<?php

    class ProductsController extends Controller
    {
        public $layout = '/layouts/content_2';

        public $isMobile = FALSE;

        public function init()
        {
            parent::init();
            // mobile detect
            $detect         = new MyMobileDetect();
            $this->isMobile = $detect->isMobile();
            if ($detect->isMobile()) {
                $this->layout = '/layouts/main_mobile';
            }
        }

        /**
         * @param $id
         *
         * @throws CHttpException
         */
        public function actionIndex($id)
        {
            $categories = WCategories::getCategoryDetail($id);
            if ($categories) {
                $parent_cate     = WCategories::getCategoryDetail($categories->parent_id);
                $this->pageTitle = Yii::t('web/full_home', 'product') . '-' . $categories->name;
                $products        = WProducts::getProductsInCategory($categories->id);
                $this->render('index', array(
                    'categories'  => $categories,
                    'parent_cate' => $parent_cate,
                    'products'    => $products,
                ));
            } else {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
        } //end index

        /**
         * @param $id
         */
        public function actionDetail($id)
        {
            $this->pageTitle = Yii::t('web/full_home', 'product');

            if ($this->isMobile) {
                $this->render('detail_mobile');
            } else {
                $this->render('detail');
            }

        }
    } //end class