<?php
    /* @var $this ACategoriesController */
    /* @var $model ACategories */
    /* @var $modelDetail ACategoriesDetail */

    $this->breadcrumbs = array(
        Yii::t('adm/label', 'categories') => array('admin'),
        $modelDetail->name,
    );

    $this->menu = array(
        array('label' => Yii::t('adm/label', 'create'), 'url' => array('create')),
        array('label' => Yii::t('adm/label', 'update'), 'url' => array('update', 'id' => $model->id)),
        array('label' => Yii::t('adm/label', 'categories'), 'url' => array('admin')),
    );
?>

<h1><?= Yii::t('adm/label', 'view') ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'       => $model,
    'attributes' => array(
        'id',
        'parent_id',
        'thumbnail',
        'sort_order',
        'status',
    ),
)); ?>
