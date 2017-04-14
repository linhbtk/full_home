<?php
/* @var $this AUsersController */
/* @var $model AUsers */

$this->breadcrumbs=array(
	'Ausers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AUsers', 'url'=>array('index')),
	array('label'=>'Create AUsers', 'url'=>array('create')),
	array('label'=>'Update AUsers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AUsers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AUsers', 'url'=>array('admin')),
);
?>

<h1>View AUsers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'email',
		'activkey',
		'createtime',
		'lastvisit',
		'superuser',
		'status',
		'parent_id',
	),
)); ?>
