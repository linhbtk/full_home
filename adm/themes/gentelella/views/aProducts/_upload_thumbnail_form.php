<?php
    /* @var $model AProducts */
    /* @var $modelDetail AProductDetail */
    /* @var $modelFiles AFiles */
    /* @var $form CActiveForm */
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <h3>Upload File</h3>
</div>
<div class="form">
    <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'                   => 'abook-files-form',
        'action'               => Yii::app()->controller->createUrl('/aProducts/images', array('media_id' => $model->id)),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => FALSE,
        'htmlOptions'          => array('enctype' => 'multipart/form-data', 'class' => 'avatar-form'),
    )); ?>
    <?php echo $form->hiddenField($model, 'id', array('value' => $model->id)) ?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <div class="clearfix"></div>
            <div role="alert" class="alert alert-danger alert-dismissible fade in" style="display:none">
                <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                    <span aria-hidden="true">×</span>
                </button>
                <div id="upload-message"></div>
            </div>

            <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.fileupload.css">

            <br/>
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Select file...</span>
                <!-- The file input field used as target for the file upload widget -->
                <input id="fileupload" type="file" name="files"/>
                <!--        <input id="fileupload" type="file" name="files[]" multiple>-->
            </span>
            <br/>
            <br/>
            <!-- The global progress bar -->
            <div id="progress" class="progress col-md-6 col-sm-12 col-xs-12 nopadding">
                <div class="progress-bar progress-bar-success"></div>
            </div>
            <!-- The container for the uploaded files -->
            <div class="clearfix"></div>
            <div id="files" class="files"></div>
            <input type="hidden" name="tempFileName" value=""/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <span id="upload-error"></span>
        </div>

        <div class="form-group">
            <?php echo CHtml::submitButton('Upload', array('name' => 'AFiles', 'class' => 'btn btn-success')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fileupload/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fileupload/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fileupload/jquery.fileupload.js"></script>
<script>
    /*jslint unparam: true */
    /*global window, $ */
    $(function () {
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url = '<?php echo Yii::app()->controller->createUrl('aProducts/upload/', array('qqfile' => '1'))?>';
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    if (typeof file.error !== "undefined") {
                        $('#progress .progress-bar').css('width', '0');
                        $('#upload-message').text(file.error);
                        $(".alert-danger").show();
                    } else {
//                            $('<p/>').text(file.name).appendTo('#files');

                        $(".alert-danger").hide();
                        $('#files').html(file.name + '&nbsp;&nbsp;&nbsp;<strong style="color:rgba(243, 156, 18, 0.88);"><i class="fa fa-check"></i>  OK</strong>');
                        $('input[name=tempFileName]').val(file.name);
                    }
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });
</script>