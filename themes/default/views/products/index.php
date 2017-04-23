<?php
    /* @var $this ProductsController */
    /* @var $categories WCategories */
    /* @var $parent_cate WCategories */
    /* @var $products WProducts */
?>
<?php $this->renderPartial('//layouts/_social'); ?>
<div class="br_top hidden-xs">
    <div class="container">
        <div class="col-md-12">
            <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'       => array(
                        '<span class="link">Hộp đựng bằng nhựa</span>',
                    ),
                    'encodeLabel' => FALSE,
                    'homeLink'    => '<img src="' . Yii::app()->theme->baseUrl . '/images/ic_menu_1_1.png" alt=""
                                                 class="icon"><span class="home_link">Đồ nhựa thủy tinh</span>',
                    'separator'   => '<img src="' . Yii::app()->theme->baseUrl . '/images/br.png"/>',
                    'htmlOptions' => array('class' => 'breadcrumb'),
                ));
            ?>
        </div>
    </div>
</div>
<div class="container">
    <?php $this->renderPartial('//layouts/_banner'); ?>
    <div class="product_list row">
        <div class="space_30"></div>
        <div class="title_cate">
            <span class="name_cate"><?= CHtml::encode($categories->name); ?></span>
            <span
                class="more_cate hidden-xs"><?= Yii::t('web/full_home', 'other_products'); ?> <?= CHtml::encode($categories->name); ?></span>
        </div>
        <div class="line_1"></div>
        <div class="space_30 hidden-xs"></div>
        <div class="list">
            <?php
                if ($products):
                    foreach ($products as $item):
                        ?>
                        <div class="col-md-3 col-xs-6">
                            <a href="<?= Yii::app()->controller->createUrl('products/detail', array('id' => $item->id)); ?>"
                               title="">
                                <div class="thumbnail">
                                    <img src="<?= Yii::app()->params->upload_dir_path . $item->thumbnail; ?>" alt="">
                                </div>
                                <div class="txt_title">
                                    <?= CHtml::encode($item->name); ?>
                                </div>
                                <div class="txt_price">
                                    <?= number_format($item->price, 0, "", "."); ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
        </div>
        <div class="space_60"></div>
    </div>
</div>
