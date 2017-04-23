<?php
    /* @var $this APartnersController */
    /* @var $model APartners */

    $this->breadcrumbs = array(
        Yii::t('adm/label', 'partners') => array('admin'),
        Yii::t('adm/label', 'create'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/label', 'manage_partners'), 'url' => array('admin')),
    );
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo Yii::t('adm/label', 'create') ?></h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <?php $this->renderPartial('_form', array('model' => $model)); ?>
            </div>
        </div>
    </div>
</div>
