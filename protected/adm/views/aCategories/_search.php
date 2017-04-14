<?php
    /* @var $this ACategoriesController */
    /* @var $model ACategories */
    /* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action'      => Yii::app()->createUrl($this->route),
        'method'      => 'get',
        'htmlOptions' => array(
            'class' => 'form-horizontal form-label-left',
        ),
    )); ?>

    <div class="form-group">
        <?php echo $form->label($model, 'id', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo $form->textField($model, 'id', array('class' => 'form-control col-md-7 col-xs-12')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, 'name', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo $form->textField($model, 'name', array('class' => 'form-control col-md-7 col-xs-12', 'size' => 60, 'maxlength' => 225)); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, 'parent_id', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo $form->textField($model, 'parent_id', array('class' => 'form-control col-md-7 col-xs-12')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, 'detail', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo $form->textField($model, 'detail', array('class' => 'form-control col-md-7 col-xs-12', 'size' => 60, 'maxlength' => 1000)); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, 'status', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo $form->textField($model, 'status', array('class' => 'form-control col-md-7 col-xs-12')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <?php echo CHtml::submitButton('Search', array('class' => 'btn btn-primary btn-sm')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->