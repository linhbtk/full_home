<?php
    /* @var $this ACategoriesController */
    /* @var $model ACategories */
    /* @var $modelDetail ACategoriesDetail */
    /* @var $form CActiveForm */
?>

<div id="crop-avatar" class="form">

    <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'                   => 'acategories-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => FALSE,
        'htmlOptions'          => array(
            'enctype' => 'multipart/form-data',
            'class'   => 'form-horizontal form-label-left avatar-form',
        ),
    )); ?>

    <?php echo $form->errorSummary($model); ?>
    <div class="clearfix"></div>
    <div class="form-inline pull-right">
        <div class="form-group">
            <div class="checkbox-nopad">
                <label>
                    <?php
                        if ($model->isNewRecord) {
                            echo $form->checkBox($model, 'status', array('checked' => 'checked', 'class' => 'flat')) . ' ' . Yii::t('adm/label', 'active');
                        } else {
                            echo $form->checkBox($model, 'status', array('class' => 'flat')) . ' ' . Yii::t('adm/label', 'active');
                        }
                    ?>
                    &nbsp;&nbsp;&nbsp;</label>
            </div>
        </div>

        <div class="form-group">
            <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('adm/label', 'create') : Yii::t('adm/label', 'save'), array('class' => 'btn btn-primary')); ?>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>

    <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'parent_id', array('class' => 'control-label col-md-2 col-xs-12')); ?>
                    <div class="col-md-10 col-xs-12">
                        <?php
                            echo $form->dropDownList($model, 'parent_id', ACategories::getParentCategories($model->id), array('prompt' => Yii::t('adm/label', 'select_parent_category'), 'class' => 'form-control'));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->label($modelDetail, 'name', array('class' => 'control-label col-md-2 col-xs-12')); ?>
                    <div class="col-md-10 col-xs-12">
                        <?php echo $form->textField($modelDetail, 'name', array('class' => 'form-control', 'maxlength' => 255)); ?>
                    </div>
                    <?php echo $form->error($modelDetail, 'name'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($modelDetail, 'description', array('class' => 'control-label col-md-2 col-xs-12')); ?>
                    <div class="col-md-10 col-xs-12">
                        <?php echo $form->textArea($modelDetail, 'description', array('maxlength' => 500, 'rows' => 3, 'cols' => 40, 'class' => 'form-control')); ?>
                    </div>
                    <?php echo $form->error($modelDetail, 'description'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($modelDetail, 'sort_order', array('class' => 'control-label col-md-2 col-xs-12')); ?>
                    <div class="col-md-10 col-xs-12">
                        <?php echo $form->textField($model, 'sort_order', array('class' => 'form-control')); ?>
                    </div>
                    <?php echo $form->error($modelDetail, 'sort_order'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'icon', array('class' => 'control-label col-md-2 col-xs-12')); ?>
                    <div class="col-md-10 col-xs-12">
                        <?php echo $form->fileField($model, 'icon'); ?>
                    </div>
                    <?php echo $form->error($model, 'icon'); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <!-- Cropping Preview -->
            <div class="thumbnail_area">
                <div class="">
                    <?php
                        $box = $this->beginWidget(
                            'booster.widgets.TbPanel',
                            array(
                                'title'       => 'Thumbnail',
                                'headerIcon'  => 'th-list',
                                'padContent'  => FALSE,
                                'htmlOptions' => array('class' => 'bootstrap-widget-table')
                            )
                        );
                    ?>
                    <div class="" style="padding: 10px">
                        <div class="avatar-view" title="">
                            <?php
                                if (isset($model->thumbnail) && $model->thumbnail != '') {
                                    $thumb_url = Yii::app()->params->upload_dir_path . $model->thumbnail;
                                } else {
                                    $thumb_url = '../uploads/upload-icon.jpg';
                                }

                                echo $thumb_url != '' ? CHtml::image($thumb_url, '', array('width' => '40%')) : ''; ?>
                            <?php echo $form->hiddenField($model, 'thumbnail', array('id' => 'thumbnail_hidden')) ?>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
            <!-- End Cropping Preview -->
        </div>
    </div>

    <?php $this->endWidget(); ?>
    <!-- Cropping modal -->
    <?php $this->renderPartial('//layouts/_crop_image_form', array(
        'model'      => $model,
        'dir_upload' => Yii::app()->params->dir_categories,
    )); ?>
</div><!-- form -->
<div class="clearfix">&nbsp;</div>
<input type="hidden" id="custom_crop_ratio" name="custom_crop_ratio" value="1">
<script language="javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/cropper_image/dist/cropper.min.js"></script>
<script language="javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/cropper_image/js/main.js"></script>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications">
        <?php
            if (isset(Yii::app()->session['userView' . Yii::app()->user->id . 'returnURL']))
                echo CHtml::link('<i class="fa fa-backward"></i> ' . 'Quay lại', Yii::app()->session['userView' . Yii::app()->user->id . 'returnURL'], array('class' => 'btn btn-warning'));
            else
                echo CHtml::link('<i class="fa fa-backward"></i> ' . 'Quay lại', array('admin'), array('class' => 'btn btn-warning'));
        ?>
    </div>
</div>