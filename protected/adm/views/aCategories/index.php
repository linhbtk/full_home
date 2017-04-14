<?php
/* @var $this ACategoriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Acategories',
);

$this->menu=array(
	array('label'=>'Create ACategories', 'url'=>array('create')),
	array('label'=>'Manage ACategories', 'url'=>array('admin')),
);
?>

<h1>Acategories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
