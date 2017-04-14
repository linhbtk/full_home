<?php
/* @var $this AUsersController */
/* @var $model AUsers */

$this->breadcrumbs=array(
	'Ausers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AUsers', 'url'=>array('index')),
	array('label'=>'Manage AUsers', 'url'=>array('admin')),
);
?>

<h1>Create AUsers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>