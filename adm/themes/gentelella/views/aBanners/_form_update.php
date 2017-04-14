<?php
/* @var $this ABannersController */
/* @var $model ABanners */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'abanners-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'          => array(
        'enctype' => 'multipart/form-data'
    )
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'title'); ?>
                <?php echo $form->textField($model, 'title', array('class'=>'form-control', 'size' => 100, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'title'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'target_link'); ?>
                <?php echo $form->textField($model, 'target_link', array('class'=>'form-control', 'size' => 100, 'maxlength' => 1000)); ?>
                <?php echo $form->error($model, 'target_link'); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'sort_order'); ?>
                <?php echo $form->textField($model, 'sort_order', array('class'=>'form-control','size' => 12, 'style' => 'width: inherit;')); ?>
                <?php echo $form->error($model, 'sort_order'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'type'); ?>
                <?php echo $form->dropDownList($model, 'type', $model->getListCategoriesType(), array('prompt' => Yii::t('adm/label', 'select_type'), 'class'=>'form-control', 'style' => 'padding:4px 12px;width: inherit;')); ?>
                <?php echo $form->error($model, 'type'); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'file'); ?>
                <?php echo $form->fileField($model, 'file', array('size' => 60, 'maxlength' => 1000)); ?>
                <?php echo $form->error($model, 'file'); ?>
            </div>

            <div class="form-group">
                <?php if (isset($_REQUEST['id']) && isset($model->img_desktop)) {
                    echo CHtml::image('../'.$model->img_desktop, "image", array("style" => "width:120px;height:100px;", "id" => "preview"));
                } else {
                    echo CHtml::image("../images/no_img.png", "no image", array("width" => "120px", "height" => "100px", "title" => "no image", "id" => "preview"));
                }?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'file_img_mobile'); ?>
                <?php echo $form->fileField($model, 'file_img_mobile', array('size' => 60, 'maxlength' => 1000)); ?>
                <?php echo $form->error($model, 'file_img_mobile'); ?>
            </div>

            <div class="form-group">
                <?php if (isset($_REQUEST['id']) && isset($model->img_mobile) ) {
                    echo CHtml::image('../'.$model->img_mobile, "image", array("style" => "width:120px;height:100px;", "id" => "preview_img_mobile"));
                } else {
                    echo CHtml::image("../images/no_img.png", "no image", array("width" => "120px", "height" => "100px", "title" => "no image", "id" => "preview_img_mobile"));
                }?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo $form->ckEditorGroup(
            $model,
            'content_html',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-12',
                ),
                'widgetOptions'      => array(
                    'editorOptions' => array(
                        'fullpage'                  => 'js:true',
                        'width'                     => '100%',
                        'resize_maxWidth'           => '100%',
                        'resize_minWidth'           => '320',
                        'filebrowserImageBrowseUrl' => '../vendors/kcfinder/browse.php?type=images',
                    )
                )
            )
        );
        ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array(1 => 'Kích hoạt', 0 => 'Ẩn'), array('class'=>'form-control','options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => TRUE)), 'style'=>'padding:4px 12px;width: inherit;')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('adm/label', 'create') : Yii::t('adm/label', 'save'), array('class' => 'btn btn-success')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    function readURL(input,div_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#'+div_id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#ABanners_file").change(function () {
        var ext = $('#ABanners_file').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'gif']) == -1) {
            $("#errorABanners_file").remove();
            $('#ABanners_file').after('<div class="errorMessage" id="errorABanners_file">The file cannot be uploaded. Only files with these extensions are allowed: jpg, jpeg, png, gif.</div>');
        } else {
            $("#errorABanners_file").remove();
            $('#preview').css("display", "block");
            readURL(this,'preview');
        }
    });
    $("#ABanners_file_img_mobile").change(function () {
        var ext = $('#ABanners_file_img_mobile').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'gif']) == -1) {
            $("#errorABanners_file_img_mobile").remove();
            $('#ABanners_file_img_mobile').after('<div class="errorMessage" id="errorABanners_file_img_mobile">The file cannot be uploaded. Only files with these extensions are allowed: jpg, jpeg, png, gif.</div>');
        } else {
            $("#errorABanners_file_img_mobile").remove();
            $('#preview_img_mobile').css("display", "block");
            readURL(this,'preview_img_mobile');
        }
    });
</script>