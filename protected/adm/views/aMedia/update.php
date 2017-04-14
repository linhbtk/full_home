<?php
    $this->breadcrumbs = array(
        $this->modelDisplayName => array('admin'),
        $model->name            => array('view', 'id' => $model->id),
        Yii::t('adm/app', 'update'),
    );
    $this->menu        = array(
        array('label' => Yii::t('adm/app', 'create') . ' ' . $this->modelDisplayAttribute, 'url' => array('create'), 'linkOptions' => array('class' => 'btn_create')),
        array('label' => Yii::t('adm/app', 'view') . ' ' . $this->modelDisplayAttribute, 'url' => array('view', 'id' => $model->id), 'linkOptions' => array('class' => 'btn_view')),
        array('label' => Yii::t('adm/app', 'manage') . ' ' . $this->modelDisplayAttribute, 'url' => array('admin'), 'linkOptions' => array('class' => 'btn_admin')),
    );
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo Yii::t('adm/actions', 'update'); ?></h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php $this->renderPartial('_form', array(
                    'model'       => $model,
                    'cate_tree'   => $cate_tree,
                    'videoFile'   => $videoFile,
                    'continue'    => $continue,
                )); ?>
            </div>
        </div>
    </div>
</div>
