<?php
    /* @var $this APartnersController */
    /* @var $model APartners */

    $this->breadcrumbs = array(
        Yii::t('adm/label', 'partners') => array('admin'),
        $model->title,
    );

    $this->menu = array(
        array('label' => Yii::t('adm/label', 'create'), 'url' => array('create')),
        array('label' => Yii::t('adm/label', 'update'), 'url' => array('update', 'id' => $model->id)),
        array('label' => Yii::t('adm/label', 'manage_partners'), 'url' => array('admin')),
    );
?>

<h1><?=Yii::t('adm/label', 'view')?> #<?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'       => $model,
    'attributes' => array(
        'id',
        'title',
        'target_link',
        'sort_order',
        array(
            'name'  => 'folder_path',
            'type'  => 'raw',
            'value' => $model->getImageUrl($model->folder_path)
        ),
        array(
            'name'  => 'status',
            'type'  => 'raw',
            'value' => $model->getStatusLabel(),
        ),
    ),
)); ?>
