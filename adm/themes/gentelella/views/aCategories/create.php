<?php
    /* @var $this ACategoriesController */
    /* @var $model ACategories */
    /* @var $modelDetail ACategoriesDetail */

    $this->breadcrumbs = array(
        Yii::t('adm/label', 'categories') => array('admin'),
        Yii::t('adm/label', 'create'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/label', 'categories'), 'url' => array('admin')),
    );
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?= Yii::t('adm/label', 'create') ?></h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <?php $this->renderPartial('_form', array('model' => $model, 'modelDetail' => $modelDetail)); ?>
            </div>
        </div>
    </div>
</div>

