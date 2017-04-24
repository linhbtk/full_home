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
            $categories = WCategoriesDetail::getCategoryDetail($id);
            if ($categories) {
                $this->pageTitle = Yii::t('web/full_home', 'product') . '-' . $categories->name;
                $parent_cate     = WCategoriesDetail::getCategoryDetail($categories->category->parent_id);
                $products        = WProducts::getProductsInCategory($categories->categories_id);
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
         *
         * @throws CHttpException
         */
        public function actionDetail($id)
        {
            $this->pageTitle = Yii::t('web/full_home', 'product');

            $product = WProductDetail::getProductDetail($id);
            if ($product) {
                $categories       = WCategoriesDetail::getCategoryDetail($product->product->categories_id);
                $parent_cate      = WCategoriesDetail::getCategoryDetail($categories->category->parent_id);
                $images           = WFiles::getListFileByMediaId($product->id);
                $related_products = WProducts::getProductsInCategory($product->product->categories_id, $product->id);
                if ($this->isMobile) {
                    $this->render('detail_mobile', array(
                        'categories'       => $categories,
                        'parent_cate'      => $parent_cate,
                        'product'          => $product,
                        'images'           => $images,
                        'related_products' => $related_products,
                    ));
                } else {
                    $this->render('detail', array(
                        'categories'       => $categories,
                        'parent_cate'      => $parent_cate,
                        'product'          => $product,
                        'images'           => $images,
                        'related_products' => $related_products,
                    ));
                }
            } else {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
        }
    } //end class