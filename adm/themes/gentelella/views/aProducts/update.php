<?php
    /* @var $this AProductsController */
    /* @var $model AProducts */
    /* @var $modelDetail AProductDetail */
    /* @var $modelFiles AFiles */
    /* @var $continue */

    $this->breadcrumbs = array(
        Yii::t('adm/label', 'products') => array('admin'),
        Yii::t('adm/label', 'update'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/label', 'products'), 'url' => array('admin')),
    );
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?= Yii::t('adm/label', 'update') ?> #<?php echo $modelDetail->name; ?></h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <?php $this->renderPartial('_form', array(
                    'model'       => $model,
                    'modelDetail' => $modelDetail,
                    'modelFiles'  => $modelFiles,
                    'cate_tree'   => $cate_tree,
                    'continue'    => $continue,
                )); ?>
            </div>
        </div>
    </div>
</div>
