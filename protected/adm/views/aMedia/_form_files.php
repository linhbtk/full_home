<div id="upload_video_file" class="modal fade view-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload Video file: <?= $model->name ?></h4>
            </div>

            <div class="modal-body">
                <div class="col-md-12 col-xs-12">
                    <div class="clearfix"></div>
                    <div class="message"></div>
                    <div class="clearfix"></div>
                    <div class="form">
                        <?php $form = $this->beginWidget('CActiveForm', array(
                            'id'                   => 'afiles-form',
                            'htmlOptions'          => array(
                                'enctype'  => 'multipart/form-data',
                                'onsubmit' => 'return false;',/* Disable normal form submit */
                            ),
                            'enableAjaxValidation' => true,
                            'clientOptions'        => array(
                                'validateOnSubmit' => true,
                            ),
                        )); ?>
                        <?php echo $form->errorSummary($modelFiles); ?>
                        <?php echo CHtml::hiddenField('video_id', $model->id, array('id' => 'video_id')); ?>
                        <?php echo CHtml::hiddenField('video_file_id', $modelFiles->id, array('id' => 'video_file_id')); ?>

                        <?php
                            $max_upload_size = 999 * 1024 * 1024;
                            echo CHtml::hiddenField('max_file_size', $max_upload_size) ?>

                        <?php echo $form->hiddenField($modelFiles, 'duration', array('value' => 100)); ?>
                        <?php $this->renderPartial('_upload_files_form', array(
                            'model'      => $model,
                            'modelFiles' => $modelFiles,
                            'form' => $form,
                            ));
                        ?>

                        <?php echo $form->hiddenField($modelFiles, 'media_id'); ?>
                        <div style="margin-top: 20px"></div>
                        <div class="row buttons">
                            <!--<?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => Yii::t('adm/app', 'save'))); ?>-->
                            <?php echo CHtml::submitButton(Yii::t('adm/app', 'Save'), array('onclick' => 'submitForm();', 'class' => 'btn btn-primary')); ?>
                        </div>
                        <?php echo CHtml::hiddenField('YII_CSRF_TOKEN', Yii::app()->request->csrfToken) ?>
                        <?php $this->endWidget(); ?>
                    </div>
                    <!-- form -->
                </div>
            </div>

            <div class="modal-footer" style="border-top: none;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-bottom:5px"><i
                        class="fa fa-close"></i> Đóng
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Process duration -->
<script>
    jQuery('button.start').click(function () {
        jQuery('span.preview video').attr('id', 'preview_video');
        return true;
    });

    function submitForm() {
        var data = $("#afiles-form").serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->controller->createUrl('aMedia/files', array('id' => $model->id, 'action' => 'add')) ?>',
            data: data,
            success: function (data) {
                if (data.status == true) {
                    /*$('#add_file').hide();*/
                    $('#upload_video_file').modal('hide');
                    $.fn.yiiGridView.update('videos-grid');
                } else {
                    $('.message').html('<div class="alert alert-danger" role="alert">Xảy ra lỗi. Vui lòng thử lại.</div>');
                }
            },
            error: function (data) { // if error occured
                $('.message').html('<div class="alert alert-danger" role="alert">Xảy ra lỗi. Vui lòng thử lại.</div>');
            },
            dataType: 'json'
        });
    }
</script>