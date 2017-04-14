<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'amedia-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>300)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'unsign_name'); ?>
        <?php echo $form->textField($model,'unsign_name',array('size'=>60,'maxlength'=>300)); ?>
        <?php echo $form->error($model,'unsign_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'code'); ?>
        <?php echo $form->textField($model,'code',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($model,'code'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'short_description'); ?>
        <?php echo $form->textField($model,'short_description',array('size'=>60,'maxlength'=>2000)); ?>
        <?php echo $form->error($model,'short_description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'full_description'); ?>
        <?php echo $form->textArea($model,'full_description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'full_description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'link'); ?>
        <?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>500)); ?>
        <?php echo $form->error($model,'link'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'thumbnail'); ?>
        <?php echo $form->textField($model,'thumbnail',array('size'=>60,'maxlength'=>500)); ?>
        <?php echo $form->error($model,'thumbnail'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'public_time'); ?>
        <?php echo $form->textField($model,'public_time'); ?>
        <?php echo $form->error($model,'public_time'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'create_time'); ?>
        <?php echo $form->textField($model,'create_time'); ?>
        <?php echo $form->error($model,'create_time'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'views'); ?>
        <?php echo $form->textField($model,'views'); ?>
        <?php echo $form->error($model,'views'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'created_by'); ?>
        <?php echo $form->textField($model,'created_by',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'created_by'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'approved_by'); ?>
        <?php echo $form->textField($model,'approved_by',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'approved_by'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'price'); ?>
        <?php echo $form->textField($model,'price'); ?>
        <?php echo $form->error($model,'price'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cp_id'); ?>
        <?php echo $form->textField($model,'cp_id'); ?>
        <?php echo $form->error($model,'cp_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'artist_id'); ?>
        <?php echo $form->textField($model,'artist_id',array('size'=>60,'maxlength'=>300)); ?>
        <?php echo $form->error($model,'artist_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'album_id'); ?>
        <?php echo $form->textField($model,'album_id',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'album_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'last_update'); ?>
        <?php echo $form->textField($model,'last_update'); ?>
        <?php echo $form->error($model,'last_update'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'extra_info'); ?>
        <?php echo $form->textArea($model,'extra_info',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'extra_info'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->textField($model,'status'); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>

    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'icon' => 'ok', 'label' => $model->isNewRecord ? Yii::t('adm/app', 'create') : Yii::t('adm/app', 'save'), 'context' => 'primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->