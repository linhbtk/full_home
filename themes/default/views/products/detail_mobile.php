<?php
    /* @var $this ProductsController */
    /* @var $categories WCategoriesDetail */
    /* @var $parent_cate WCategoriesDetail */
    /* @var $product_detail WProductDetail */
    /* @var $related_products WProducts */
    /* @var $images WFiles */
?>
<div class="container">
    <h2 class="product_name"><?= CHtml::encode($product_detail->name) ?></h2>

    <div id="detailBox">
        <div id="detailImg" class="flexslider col-md-6 col-xs-12">
            <ul class="slides">
                <?php
                    if ($images):
                        foreach ($images as $img):?>
                            <li data-thumb="<?= Yii::app()->params->upload_dir_path . $img->folder_path; ?>">
                                <img src="<?= Yii::app()->params->upload_dir_path . $img->folder_path; ?>"/>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </ul>
        </div>
        <div id="detail_top_info" class="detail_top_info col-md-6">
            <div class="price text-center">
                <?= Yii::t('web/full_home', 'product_price') ?>
                <span class="price_des"><?= CHtml::encode(number_format($product_detail->price, 0, "", ".")); ?>đ</span>
            </div>
            <div class="item">
                <div class="col-md-4 col-xs-4 no_pad">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/arrow_2.png"/>
                    <span class="title"><?= Yii::t('web/full_home', 'product_code') ?></span>
                </div>
                <div class="col-md-8 col-xs-8">
                    <span class="des"><?= CHtml::encode($product_detail->product->code); ?></span>
                </div>
            </div>
            <div class="space_10"></div>
            <div class="item">
                <div class="col-md-4 col-xs-4 no_pad">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/arrow_2.png"/>
                    <span class="title"><?= Yii::t('web/full_home', 'product_size') ?></span>
                </div>
                <div class="col-md-8 col-xs-8">
                    <span class="des"><?= CHtml::encode($product_detail->size); ?></span>
                </div>
            </div>
            <div class="space_10"></div>
            <div class="item">
                <div class="col-md-4 col-xs-4 no_pad">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/arrow_2.png"/>
                    <span class="title"><?= Yii::t('web/full_home', 'product_material') ?></span>
                </div>
                <div class="col-md-8 col-xs-8">
                    <span class="des"><?= CHtml::encode($product_detail->material); ?></span>
                </div>
            </div>
            <div class="space_30"></div>
            <div class="note_des">
                <?= $product_detail->description; ?>
            </div>
            <div class="space_30"></div>
        </div>
    </div>
    <?php if ($related_products): ?>
        <div class="product_list row">
            <div class="space_30"></div>
            <div class="title">
                <?= Yii::t('web/full_home', 'related_products'); ?>
            </div>
            <div class="space_20"></div>
            <div class="list">
                <?php
                    foreach ($related_products as $item):
                        $this->renderPartial('_block_product', array('item' => $item));
                    endforeach;
                ?>
            </div>
            <div class="space_60"></div>
        </div>
    <?php endif; ?>
</div>
