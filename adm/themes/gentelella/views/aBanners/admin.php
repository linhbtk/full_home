<?php
    /* @var $this ABannersController */
    /* @var $model ABanners */

    $this->breadcrumbs = array(
        Yii::t('adm/label', 'banners'),
    );

    Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#abanners-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="x_panel">
    <div class="x_title">
        <h2><?= Yii::t('adm/label', 'manage_banners') ?></h2>

        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="pull-right">
            <?php echo CHtml::link(Yii::t('adm/app', 'Create'), array('create'), array('class' => 'btn btn-warning')); ?>
        </div>
        <div class="clearfix"></div>

        <?php $this->widget(
            'booster.widgets.TbTabs',
            array(
                'type'        => 'tabs',
                'tabs'        => array(
                    array(
                        'label'   => Yii::t('adm/label', 'Kích hoạt'),
                        'content' => $this->renderPartial('_tab_list_by_type', array('model' => $model, 'status' => '1'), TRUE),
                        'active'  => TRUE
                    ),
                    array(
                        'label'   => Yii::t('adm/label', 'Ẩn'),
                        'content' => $this->renderPartial('_tab_list_by_type', array('model' => $model, 'status' => '0'), TRUE),

                    ),
                ),
                'htmlOptions' => array('class' => 'site_manager')
            )
        ); ?>
    </div>
</div>

