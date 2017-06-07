<?php
    /* @var $model ACategories */
    /* @var $modelDetail ACategoriesDetail */
    /* @var $form CActiveForm */
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <h3>Upload File</h3>
</div>
<div class="form">
    <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'                   => 'thumb_form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => FALSE,
        'htmlOptions'          => array('enctype' => 'multipart/form-data', 'class' => 'avatar-form'),
    )); ?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <div class="clearfix"></div>
            <div role="alert" class="alert alert-danger alert-dismissible fade in" style="display:none">
                <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                    <span aria-hidden="true">×</span>
                </button>
                <div id="upload-message_thumb"></div>
            </div>

            <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.fileupload.css">

            <br/>
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Select file...</span>
                <!-- The file input field used as target for the file upload widget -->
                <input id="fileupload_thumb" type="file" name="files"/>
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
            <div id="files_thumb" class="files"></div>
            <input type="hidden" name="tempFileName" value=""/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <span id="upload-error"></span>
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-success" onclick="previewThumbnail();">
                OK
            </button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->

<script>
    /*jslint unparam: true */
    /*global window, $ */
    $(function () {
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url = '<?php echo Yii::app()->controller->createUrl('aPartners/upload/', array('qqfile' => '1'))?>';
        $('#fileupload_thumb').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    if (typeof file.error !== "undefined") {
                        $('#progress .progress-bar').css('width', '0');
                        $('#upload-message_thumb').text(file.error);
                        $(".alert-danger").show();
                    } else {
                        $(".alert-danger").hide();
                        $('#files_thumb').html(file.name + '&nbsp;&nbsp;&nbsp;<strong style="color:rgba(243, 156, 18, 0.88);"><i class="fa fa-check"></i>  OK</strong>');
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
    function previewThumbnail() {
        var form_data = new FormData(document.getElementById("thumb_form"));//id_form
        $.ajax({
            url: '<?=Yii::app()->controller->createUrl('aPartners/images')?>',
            type: "POST",
            dataType: "json",
            data: form_data,
            enctype: 'multipart/form-data',
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            success: function (result) {
                if (result.status == true) {
                    $(".alert-danger").hide();
                    $('#thumbnail_hidden').val(result.file_name);
                    $('#thumbnail_pre').attr('src', result.file_name);
                    $('.img_thumbnail').modal('hide');
                } else {
                    $('#upload-message_thumb').text(result.msg);
                    $(".alert-danger").show();
                }
            }
        });
    }
</script>