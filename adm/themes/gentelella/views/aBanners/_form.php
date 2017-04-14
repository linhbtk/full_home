<?php
    /* @var $this ABannersController */
    /* @var $model ABanners */
    /* @var $form CActiveForm */
?>

<div class="form">
    <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'                   => 'abanners-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => FALSE,
        'htmlOptions'          => array('enctype' => 'multipart/form-data', 'class' => 'form-horizontal form-label-left')
    )); ?>

    <?php echo $form->errorSummary($model); ?>
    <div class="clearfix"></div>
    <div class="form-inline pull-right">
        <div class="form-group">
            <div class="checkbox-nopad">
                <label>
                    <?php
                        if ($model->isNewRecord) {
                            echo $form->checkBox($model, 'status', array('checked' => 'checked', 'class' => 'flat')) . ' ' . Yii::t('adm/app', 'Active');
                        } else {
                            echo $form->checkBox($model, 'status', array('class' => 'flat')) . ' ' . Yii::t('adm/app', 'Active');
                        }
                    ?>
                    &nbsp;&nbsp;&nbsp;</label>
            </div>
        </div>


    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'title'); ?>
                <?php echo $form->textField($model, 'title', array('class' => 'form-control', 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'title'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'target_link'); ?>
                <?php echo $form->textField($model, 'target_link', array('class' => 'form-control', 'maxlength' => 1000)); ?>
                <?php echo $form->error($model, 'target_link'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'sort_order'); ?>
                <?php echo $form->textField($model, 'sort_order', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'sort_order'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- Cropping Preview -->
                <div id="crop-banner-desktop">
                    <div class="thumbnail_area">
                        <?php $box = $this->beginWidget(
                            'booster.widgets.TbPanel',
                            array(
                                'title'       => 'Image Mobile',
                                'headerIcon'  => 'th-list',
                                'padContent'  => FALSE,
                                'htmlOptions' => array('class' => 'bootstrap-widget-table')
                            )
                        ); ?>
                        <div style="padding: 10px;">
                            <div class="avatar-view" title="">
                                <?php
                                    if (!$model->isNewRecord) {
                                        $thumb_url = '../' . $model->img_mobile;
                                    } else {
                                        if ($model->img_mobile != '') {
                                            $thumb_url = '../' . $model->img_mobile;
                                        } else {
                                            $thumb_url = '../ebooks/uploads/upload-icon.jpg';
                                        }

                                    };
                                    //$thumb_url = str_replace(Yii::app()->params->upload_dir_path . Yii::app()->params->upload_dir_path, Yii::app()->params->upload_dir_path, $thumb_url);

                                    echo $thumb_url != '' ? CHtml::image($thumb_url, '', array('width' => '40%')) : ''; ?>
                                <?php echo $form->hiddenField($model, 'img_mobile', array('id' => 'thumbnail_hidden')) ?>
                            </div>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
                <!-- End Cropping Preview -->
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo CHtml::image($model->img_desktop, "image", array("style" => "display:none;width:120px;height:100px;", "id" => "preview_img_mobile")); ?>
                </div>
            </div>
        </div>
        <!--CKEditor-->
        <div class="form-group">
            <?php
                echo $form->ckEditorGroup(
                    $model,
                    'content_html',
                    array(
                        'wrapperHtmlOptions' => array(
                            'class' => '',
                        ),
                        'widgetOptions'      => array(
                            'editorOptions' => array(
                                'fullpage'        => 'js:true',
                                'width'           => '100%',
                                'height'          => '200px',
                                'resize_maxWidth' => '100%',
                                'resize_minWidth' => '320',
//                                    'filebrowserImageBrowseUrl' => '../vendors/kcfinder/browse.php?type=images',

                                'removePlugins'        => 'elementspath,save,font',
                                'toolbarCanCollapse'   => 'false',
                                'bodyClass'            => 'formWidget',
                                'toolbar'              => array(
                                    array('Source', '-',
                                        'Bold', 'Italic', 'Underline', 'Strike', '-',
                                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                                        'NumberedList', 'BulletedList', '-',
                                        'Outdent', 'Indent', 'Blockquote', '-',
                                        'Link', 'Unlink', '-'),
                                    array('Format', 'Image', 'Flash', 'Table', 'Smiley', 'SpecialChar', '-',
                                        'TextColor', 'BGColor', '-',
                                        'Undo', 'Redo', '-',
                                        'Maximize'),
                                ),
                                'format_p'             => array(
                                    'element'    => 'p',
                                    'attributes' => NULL,
                                ),
                                'ignoreEmptyParagraph' => TRUE,
                                'font_style'           => array(
                                    'element' => NULL,
                                )
                            ),
                            'htmlOptions'   => array('class' => 'formWidget')
                        )
                    )
                );
            ?>
        </div>
        <!--End CKEditor-->
        <div class="form-group">
            <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('adm/app', 'Create') : Yii::t('adm/app', 'Save'), array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>

        <!-- Cropping modal -->
        <?php $this->renderPartial('/layouts/_crop_image_form', array(
            'model'      => $model,
            'dir_upload' => 'banners',
        ));
        ?>

        <!-- Cropping modal -->
        <?php $this->renderPartial('/layouts/_crop_image_form_mobile', array(
            'model'      => $model,
            'dir_upload' => 'banners',
        ));
        ?>
    </div><!-- form -->

    <input type="hidden" id="custom_crop_ratio" name="custom_crop_ratio" value="1">
    <input type="hidden" id="custom_crop_ratio_mobile" name="custom_crop_ratio_mobile" value="2">
    <script language="javascript"
            src="<?php echo Yii::app()->theme->baseUrl ?>/cropper_image/dist/cropper.min.js"></script>
    <script language="javascript"
            src="<?php echo Yii::app()->theme->baseUrl ?>/cropper_image/js/crop-banner.js"></script>
    <script language="javascript"
            src="<?php echo Yii::app()->theme->baseUrl ?>/cropper_image/js/crop-banner-mobile.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

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