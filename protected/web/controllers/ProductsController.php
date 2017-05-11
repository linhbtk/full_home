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
            $category          = WCategories::model()->findByPk($id);
            $categories_detail = WCategoriesDetail::getCategoryDetail($id);
            if ($category && $categories_detail) {
                $this->pageTitle = Yii::t('web/full_home', 'product') . ' - ' . $categories_detail->name;
                $parent_cate     = WCategoriesDetail::getCategoryDetail($category->parent_id);
                if ($category->checkHasChild($id)) {//list categories
                    $products = WProducts::getProductsOfCategories($id);
                    $this->render('index', array(
                        'categories'  => $categories_detail,
                        'parent_cate' => $parent_cate,
                        'products'    => $products,
                    ));
                } else {//products in categories_id
                    $products = WProducts::getProductsInCategory($id, '', TRUE);
                    $this->render('categories', array(
                        'categories'  => $categories_detail,
                        'parent_cate' => $parent_cate,
                        'products'    => $products,
                    ));
                }
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
            $product        = WProducts::getProduct($id);
            $product_detail = WProductDetail::getProductDetail($id);
            if ($product && $product_detail) {
                $this->pageTitle  = Yii::t('web/full_home', 'product') . ' - ' . $product_detail->name;
                $categories       = WCategoriesDetail::getCategoryDetail($product->categories_id);
                $parent_cate      = WCategoriesDetail::getCategoryDetail($categories->category->parent_id);
                $images           = WFiles::getListFileByMediaId($product->id);
                $images_content   = WFiles::getListFileByMediaId($product->id, WFiles::TYPE_CONTENT);
                $related_products = WProducts::getProductsInCategory($product->categories_id, $product->id);
                if ($this->isMobile) {
                    $this->render('detail_mobile', array(
                        'categories'       => $categories,
                        'parent_cate'      => $parent_cate,
                        'product_detail'   => $product_detail,
                        'images'           => $images,
                        'images_content'   => $images_content,
                        'related_products' => $related_products,
                    ));
                } else {
                    $this->render('detail', array(
                        'categories'       => $categories,
                        'parent_cate'      => $parent_cate,
                        'product_detail'   => $product_detail,
                        'images'           => $images,
                        'images_content'   => $images_content,
                        'related_products' => $related_products,
                    ));
                }
            } else {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
        }

        /**
         * actionSearch product
         *
         * @param null $q
         */
        public function actionSearch($q = NULL)
        {
            if (isset($_REQUEST['WProduct']) || isset($_REQUEST['ajax'])) {
                $p        = new CHtmlPurifier();
                $keyword  = $p->purify($_REQUEST['WProduct']['keyword']);
                $products = WProducts::searchProductsByKeywords(trim($keyword));

                $this->render(
                    'search',
                    array(
                        'keyword'  => $keyword,
                        'products' => $products
                    )
                );
            }
        }
    } //end class