<?php
    /* @var $this ABannersController */
    /* @var $model ABanners */

    $this->breadcrumbs = array(
        'Banners' => array('admin'),
        $model->title,
    );

    $this->menu = array(
        array('label' => 'Create Banners', 'url' => array('create')),
        array('label' => 'View Banners', 'url' => array('view', 'id' => $model->id)),
        array('label' => 'Manage Banners', 'url' => array('admin')),
    );
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo Yii::t('adm/app', 'Update') ?>: <?php echo $model->title; ?></h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <?php $this->renderPartial('_form', array('model' => $model)); ?>
            </div>
        </div>
    </div>
</div>