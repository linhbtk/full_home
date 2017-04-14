<?php
/* @var $this AUsersController */
/* @var $model AUsers */

$this->breadcrumbs=array(
	'Ausers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AUsers', 'url'=>array('index')),
	array('label'=>'Create AUsers', 'url'=>array('create')),
	array('label'=>'View AUsers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AUsers', 'url'=>array('admin')),
);
?>

<h1>Update AUsers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>