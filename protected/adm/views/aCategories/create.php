<?php
    /* @var $this ACategoriesController */
    /* @var $model ACategories */

    $CHttpRequest = new CHttpRequest();
    $type         = $CHttpRequest->getParam('t');

    if ($type != '') {
        $this->breadcrumbs = array(
            'Nhân vật' => array('admin', 't' => 'char'),
            Yii::t('adm/app', 'Create'),
        );
    } else {
        $this->breadcrumbs = array(
            Yii::t('adm/book', 'ACategories') => array('admin'),
            Yii::t('adm/app', 'Create'),
        );
    }
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo Yii::t('adm/app', 'Create') ?> danh mục</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <?php $this->renderPartial('_form', array('model' => $model)); ?>
            </div>
        </div>
    </div>
</div>
