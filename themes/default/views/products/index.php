<?php
    /* @var $this ProductsController */
    /* @var $categories WCategoriesDetail */
    /* @var $parent_cate WCategoriesDetail */
    /* @var $products WProducts */

    if (isset($parent_cate->name)) {
        $homeLink = '<img src="' . Yii::app()->theme->baseUrl . '/images/ic_menu_1_1.png" alt=""
                                                 class="icon"><span class="home_link">' . CHtml::encode($parent_cate->name) . '</span>';
    } else {
        $homeLink = '<i class="glyphicon glyphicon-home" style="color: #FFF;margin-right: 10px;"></i><span class="home_link">' . Yii::t('web/full_home', 'homepage') . '</span>';
    }
?>
<?php $this->renderPartial('//layouts/_social'); ?>
<div class="br_top hidden-xs">
    <div class="container">
        <div class="col-md-12">
            <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'       => array(
                        '<span class="link">' . CHtml::encode($categories->name) . '</span>',
                    ),
                    'encodeLabel' => FALSE,
                    'homeLink'    => $homeLink,
                    'separator'   => '<img src="' . Yii::app()->theme->baseUrl . '/images/br.png"/>',
                    'htmlOptions' => array('class' => 'breadcrumb'),
                ));
            ?>
        </div>
    </div>
</div>
<div class="container">
    <?php $this->renderPartial('//layouts/_banner'); ?>
    <div class="product_list">
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
                        $this->renderPartial('_block_product', array('item' => $item));
                    endforeach;
                endif; ?>
        </div>
        <div class="space_60"></div>
    </div>
</div>
