<div class="br_top hidden-xs">
    <div class="container">
        <div class="col-md-12">
            <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'       => array(
                        '<span class="link">Hộp đựng thực phẩm</span>',
                        '<span class="link">Hộp thủy tinh</span>',
                    ),
                    'encodeLabel' => FALSE,
                    'homeLink'    => '<img src="' . Yii::app()->theme->baseUrl . '/images/ic_menu_1_1.png" alt=""
                                                 class="icon"><span class="home_link">Đồ gia dụng</span>',
                    'separator'   => '<img src="' . Yii::app()->theme->baseUrl . '/images/br.png"/>',
                    'htmlOptions' => array('class' => 'breadcrumb'),
                ));
            ?>
        </div>
    </div>
</div>
<div class="container">
    <div id="detailBox">
        <div id="detailImg" class="flexslider col-md-6 col-xs-12">
            <ul class="slides">
                <li data-thumb="<?= Yii::app()->theme->baseUrl ?>/images/product_detail.jpg">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/product_detail.jpg"/>
                </li>
                <li data-thumb="<?= Yii::app()->theme->baseUrl ?>/images/product_detail_1.jpg">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/product_detail_1.jpg"/>
                </li>
                <li data-thumb="<?= Yii::app()->theme->baseUrl ?>/images/product_detail_2.jpg">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/product_detail_2.jpg"/>
                </li>
                <li data-thumb="<?= Yii::app()->theme->baseUrl ?>/images/product_detail_3.jpg">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/product_detail_3.jpg"/>
                </li>
                <li data-thumb="<?= Yii::app()->theme->baseUrl ?>/images/product_detail_4.jpg">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/product_detail_4.jpg"/>
                </li>
            </ul>
        </div>
        <div id="detail_top_info" class="detail_top_info col-md-6">
            <h2>Bình nước nhựa Komax</h2>

            <div class="item">
                <div class="col-md-4 no_pad_left">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/arrow_2.png"/>
                    <span class="title">Mã sản phẩm</span>
                </div>
                <div class="col-md-8">
                    <span class="des"> 20.16301 million</span>
                </div>
            </div>
            <div class="space_10"></div>
            <div class="item">
                <div class="col-md-4 no_pad_left">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/arrow_2.png"/>
                    <span class="title">Kích thước</span>
                </div>
                <div class="col-md-8">
                    <span class="des">89 x82 x 250 (H) mm / 1.0L</span>
                </div>
            </div>
            <div class="space_10"></div>
            <div class="item">
                <div class="col-md-4 no_pad_left">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/arrow_2.png"/>
                    <span class="title">Chất liệu</span>
                </div>
                <div class="col-md-8">
                    <span class="des">[Lid] Polypropylene (PP) [body] tri tan (PCT)</span>
                </div>
            </div>
            <div class="space_20"></div>
            <div class="note">Lưu ý khi sử dụng</div>
            <div class="note_des">
                <p>- Không nên hâm nóng trong lò vi sóng quá 3 phút.</p>

                <p>- Tránh bảo quản thực phẩm có nhiều dầu mỡ và phẩm màu.</p>

                <p>- Mở nắp sản phẩm khi sử dụng trong lò vi sóng.</p>

                <p>- Không để gần lửa, không sử dụng trong lò nướng.</p>
            </div>
            <div class="space_30"></div>
            <div class="price">
                Giá : <span class="price_des">135.000đ</span>
            </div>
        </div>
    </div>
    <div class="product_list">
        <div class="space_30"></div>
        <div class="title">
            <?= Yii::t('web/full_home', 'related_products'); ?>
        </div>
        <div class="space_60"></div>
        <div class="list">
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/product_3.jpg" alt="">
                </div>
                <div class="txt_title">
                    Hộp Kloken 520ml
                </div>
                <div class="txt_price">
                    Giá: 50.000đ
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/product_3.jpg" alt="">
                </div>
                <div class="txt_title">
                    Hộp Kloken 520ml
                </div>
                <div class="txt_price">
                    Giá: 50.000đ
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/product_3.jpg" alt="">
                </div>
                <div class="txt_title">
                    Hộp Kloken 520ml
                </div>
                <div class="txt_price">
                    Giá: 50.000đ
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/product_3.jpg" alt="">
                </div>
                <div class="txt_title">
                    Hộp Kloken 520ml
                </div>
                <div class="txt_price">
                    Giá: 50.000đ
                </div>
            </div>
        </div>
        <div class="space_60"></div>
    </div>
</div>
