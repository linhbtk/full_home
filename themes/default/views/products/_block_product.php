<?php
    /* @var $this ProductsController */
    /* @var $data WProducts */
?>
<div class="col-md-3 col-xs-6">
    <a href="<?= Yii::app()->controller->createUrl('products/detail', array('id' => $data->id)); ?>"
       title="">
        <div class="thumbnail">
            <img src="<?= Yii::app()->params->upload_dir_path . $data->thumbnail; ?>" alt="">
        </div>
        <div class="txt_title">
            <?= CHtml::encode($data->name); ?>
        </div>
        <div class="txt_price">
            <?= CHtml::encode(number_format($data->price, 0, "", ".")); ?>
        </div>
    </a>
</div>
