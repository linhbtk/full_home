<?php
    /* @var $this ProductsController */
    /* @var $item WProducts */
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
            <?= CHtml::encode(number_format($item->price, 0, "", ".")); ?>
        </div>
    </a>
</div>
