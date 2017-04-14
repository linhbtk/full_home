<?php
    $this->breadcrumbs = array(
        $this->modelDisplayName => array('admin'),
        Yii::t('adm/app', 'create'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/app', 'manage') . ' ' . $this->modelDisplayAttribute, 'url' => array('admin'), 'linkOptions' => array('class' => 'btn_admin')),
    );
?>
<div class="x_panel">
    <div class="x_title">
        <h2><?= Yii::t('adm/app', 'create'); ?> </h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <?php $this->renderPartial('_form', array('model' => $model,'videoFile' => $videoFile,)); ?>
    </div>
</div>
