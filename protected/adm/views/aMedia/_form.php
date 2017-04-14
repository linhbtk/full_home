<?php
    $tab_class       = '';
    $data_tab_toggle = 'tab';
    $tab2         = '';
    $tab1         = 'active';
    $tab1_content = 'active in';
    $tab2_content = '';
    if ($model->isNewReCord) {
        $cate_tree       = AIOTreeFunction::getTreeArray($model->categories, Yii::app()->params->categories_type['VIDEOS'], true);
        $tab_class       = 'disabled';
        $data_tab_toggle = '';
    }else{
        $continue = Yii::app()->request->getParam('continue');
        if (isset($continue) && $continue) {
            $tab1         = '';
            $tab2         = 'active';
            $tab2_content = 'active in';
            $tab1_content = '';
        }
    }
?>
<style>
    form input, form select, form textarea {
        height: inherit !important;
    }
</style>
<div class="">
    <div class="form" id="crop-avatar">
        <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
            'id'                   => 'amedia-form',
            'enableAjaxValidation' => true,
            'htmlOptions'          => array('enctype' => 'multipart/form-data', 'class' => 'form-horizontal form-label-left avatar-form')
        )); ?>

        <?php echo $form->errorSummary($model); ?>
        <div class="clearfix"></div>

        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="<?=$tab1;?>">
                    <a href="#tab_content1" role="tab" data-toggle="tab" aria-expanded="true">Thông tin cơ bản</a>
                </li>
                <li role="presentation" class="<?= $tab_class; ?> <?=$tab2;?>">
                    <a href="#tab_content2" role="tab" data-toggle="<?= $data_tab_toggle; ?>" aria-expanded="false">Upload
                        ảnh & File</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade <?=$tab1_content;?>" id="tab_content1">
                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
                                        <?php echo $form->textField($model, 'name', array('placeholder' => Yii::t('common/Videos', 'name'), 'class' => 'form-control', 'size' => 60, 'maxlength' => 300)); ?>
                                        <?php echo $form->error($model, 'name'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $form->labelEx($model, 'artist_id', array('class' => 'control-label')); ?>
                                        <?php
                                            $categories_type = array();
                                            if (!$model->isNewRecord)
                                                $categories_type = explode(',', $model->artist_id);
                                            $this->widget(
                                                'booster.widgets.TbSelect2',
                                                array(
                                                    'asDropDownList' => true,
                                                    'model'          => $model,
                                                    'attribute'      => 'artist_id',
                                                    'data'           => $model->getArtistList(),
                                                    'val'            => $categories_type,
                                                    'options'        => array(
                                                        'placeholder'     => 'Nghệ sỹ',
                                                        'width'           => '100%',
                                                        'tokenSeparators' => array(','),
                                                    ),

                                                )
                                            ); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $form->labelEx($model, 'album_id', array('class' => 'control-label')); ?>
                                        <?php
                                            $categories_type = array();
                                            if (!$model->isNewRecord)
                                                $categories_type = explode(',', $model->album_id);

                                            $this->widget(
                                                'booster.widgets.TbSelect2',
                                                array(
                                                    'asDropDownList' => true,
                                                    'model'          => $model,
                                                    'attribute'      => 'album_id',
                                                    'data'           => $model->getAlbumList(),
                                                    'val'            => $categories_type,
                                                    'options'        => array(
                                                        'placeholder'     => 'Album',
                                                        'width'           => '100%',
                                                        'tokenSeparators' => array(','),
                                                    ),
                                                )
                                            ); ?>
                                    </div>

<!--                                    <div class="form-group">-->
<!--                                        --><?php //echo $form->labelEx($model, 'short_description', array('class' => 'control-label')); ?>
<!--                                        --><?php //echo $form->textArea($model, 'short_description', array('placeholder' => 'Mô tả ngắn', 'maxlength' => 100, 'class' => 'form-control', 'style' => 'height: inherit !important;')); ?>
<!--                                    </div>-->
                                    <div class="form-group" style="padding-top: 5px">
                                        <?php echo $form->labelEx($model, 'views', array('class' => 'control-label')); ?>
                                        <?php echo $form->textField($model, 'views', array('class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'views'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo $form->labelEx($model, 'type', array('class' => 'control-label')); ?>
                                        <?php
                                            echo $form->dropDownList($model, 'type', $model->getTypeList(), array('class' => 'form-control','style'=>'width:100%;'));
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $form->labelEx($model, 'link', array('class' => 'control-label')); ?>
                                        <?php
                                            echo $form->textField($model, 'link', array('class' => 'form-control'));
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($model, 'price', array('class' => 'control-label')); ?>
                                        <?php echo $form->dropDownList($model, 'price', $model->getPriceList(), array('class' => 'form-control', 'style' => 'width:100%')); ?>
                                        <?php echo $form->error($model, 'price'); ?>
                                    </div>
<!--                                    <div class="form-group">-->
<!--                                        --><?php //echo $form->labelEx($model, 'views', array('class' => 'control-label')); ?>
<!--                                        --><?php //echo $form->textField($model, 'views', array('class' => 'form-control')); ?>
<!--                                        --><?php //echo $form->error($model, 'views'); ?>
<!--                                    </div>-->
                                    <div class="form-group">
                                        <?php echo $form->label($model, 'public_time'); ?>
                                        <div class="input-prepend input-group" style="margin-bottom: 5px;">
                                                        <span class="add-on input-group-addon">
                                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                            <?php
                                                $model->public_time = ($model->isNewRecord) ? date('d/m/Y H:i:s') : date('d/m/Y H:i:s', strtotime($model->public_time));
                                                echo $form->textField($model, 'public_time', array('class' => 'form-control'));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0 10px;">
                                <?php
                                    echo $form->ckEditorGroup(
                                        $model,
                                        'full_description',
                                        array(
                                            'wrapperHtmlOptions' => array(
                                                'class' => '',
                                            ),
                                            'widgetOptions'      => array(
                                                'editorOptions' => array(
                                                    'fullpage'        => 'js:true',
                                                    'width'           => '100%',
                                                    'height'          => '150px',
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
                                                        'attributes' => null,
                                                    ),
                                                    'ignoreEmptyParagraph' => true,
                                                    'font_style'           => array(
                                                        'element' => null,
                                                    )
                                                ),
                                                'htmlOptions'   => array('class' => 'formWidget')
                                            )
                                        )
                                    );
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <?php $box = $this->beginWidget(
                                    'booster.widgets.TbPanel',
                                    array(
                                        'title'       => Yii::t('adm/media', 'choose_categories'),
                                        'headerIcon'  => 'th-list',
                                        'padContent'  => false,
                                        'htmlOptions' => array('class' => 'bootstrap-widget-table')
                                    )
                                ); ?>
                                <div style="padding:10px;">
                                    <?php
                                        $this->Widget('ext.AIOTree.AIOTree2', array(
                                            'model'          => $model,
                                            'attribute'      => 'categories',
                                            'data'           => $cate_tree,
                                            'type'           => 'checkbox',
                                            'parentShow'     => true,
                                            'parentTag'      => 'div',
                                            'parentId'       => 'aiotree_id',
                                            'header'         => '',
                                            'checkAllText'   => Yii::t('adm/actions', 'check_all'),
                                            'selectParent'   => true,
                                            'controlShow'    => false,
                                            'controlDivider' => ' | ',
                                            'controlTag'     => 'div',
                                            'controlClass'   => 'expand_collapse',
                                            'controlId'      => 'CId',
                                            'controlLabel'   => array(
                                                'expand'   => '',
                                                'collapse' => '',
                                            ),
                                        ));
                                    ?>
                                </div>
                                <?php $this->endWidget(); ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade <?=$tab2_content;?>" id="tab_content2">
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <!-- Cropping Preview -->
                            <div class="thumbnail_area">
                                <div class="">
                                    <?php
                                        $box = $this->beginWidget(
                                            'booster.widgets.TbPanel',
                                            array(
                                                'title'       => Yii::t('adm/media', 'thumbnail'),
                                                'headerIcon'  => 'th-list',
                                                'padContent'  => false,
                                                'htmlOptions' => array('class' => 'bootstrap-widget-table')
                                            )
                                        );
                                    ?>
                                    <div class="" style="padding: 10px">
                                        <div class="avatar-view" title="">
                                            <?php
                                                if (isset($model->thumbnail) && $model->thumbnail != '') {
                                                    $thumb_url = '../' . $model->thumbnail;
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
                        <div class="col-md-8 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php if (Yii::app()->user->hasFlash('error')): ?>
                                    <div role="alert" class="alert alert-danger alert-dismissible fade in">
                                        <button aria-label="Close" data-dismiss="alert" class="close"
                                                type="button">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <?php echo Yii::app()->user->getFlash('error'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php
                                    echo CHtml::link('<i class="fa fa-plus"></i> ' . Yii::t('adm/media', 'add_file'), 'javascript:;', array('id' => 'add_file', 'class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '.view-modal-lg'));
                                    //list video file
                                    $this->renderPartial('_tab_list_file_by_status', array('model' => $model, 'modelFiles' => $videoFile));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications">
                <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('adm/app', 'continue') : Yii::t('adm/app', 'Save'), array('class' => 'btn btn-primary')); ?>
                <?php
                    if (isset(Yii::app()->session['userView' . Yii::app()->user->id . 'returnURL']))
                        echo CHtml::link('<i class="fa fa-backward"></i> ' . 'Quay lại', Yii::app()->session['userView' . Yii::app()->user->id . 'returnURL'], array('class' => 'btn btn-warning'));
                    else
                        echo CHtml::link('<i class="fa fa-backward"></i> ' . 'Quay lại', array('admin'), array('class' => 'btn btn-warning'));
                ?>
            </div>
        </div>
        <?php $this->endWidget(); ?><!--end form-->

        <!-- Cropping modal -->
        <?php $this->renderPartial('/layouts/_crop_image_form', array(
            'model'      => $model,
            'dir_upload' => 'media',
        ));
        ?>
        <!-- Cropping modal -->
        <!-- add Video file modal -->
        <?php $this->renderPartial('_form_files', array('model' => $model, 'modelFiles' => $videoFile, 'action' => 'add')) ?>
    </div>
    <!-- form -->
</div>


<!--modal preview video-->
<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'modal_preview_video', 'htmlOptions' => array('style' => 'z-index: 1041;'))
); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><?php echo Yii::t('adm/media', 'preview'); ?> <span id="video_name"></span></h4>
</div>

<div class="modal-body">
    <!-- JWPlayer -->
    ​
    <script src="<?= Yii::app()->theme->baseUrl ?>/js/jwplayer/jwplayer.js"></script>
    <script>jwplayer.key = "ekOj7z6QgNVVyJrzCEIIJDRRUIO9zxJkB4eHAQ==";</script>

    <div id="jwplayer_video">Loading the player...</div>

</div>

<div class="modal-footer">
    <?php $this->widget(
        'booster.widgets.TbButton',
        array(
            'label'       => 'Close',
            'url'         => '#',
            'htmlOptions' => array(
                'data-dismiss' => 'modal')
        )
    ); ?>
</div>
<?php $this->endWidget(); ?>

<script language="javascript">
    <!--Dừng file media đang chạy khi đóng popup xem trước file -->
    $('#modal_preview_video').on('hidden.bs.modal', function () {
        $("#modal_preview_video video")[0].load();
    })
</script>
<!--modal preview video-->
<!--Js and input for Crop Image-->
<input type="hidden" id="custom_crop_ratio" name="custom_crop_ratio" value="1.75">
<script language="javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/cropper_image/dist/cropper.min.js"></script>
<script language="javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/cropper_image/js/main.js"></script>
<!--End Js and input for Crop Image-->

<!--Js for datepicker-->
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/moment.min2.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->theme->baseUrl; ?>/js/datepicker/daterangepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#AMedia_public_time').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: true,
            timePickerIncrement: 5,
            format: 'DD/MM/YYYY hh:mm:ss',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            locale: {
                applyLabel: 'Áp dụng',
                cancelLabel: 'Đóng',
                daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                firstDay: 1
            }
        }, function () {
        });
    });
</script>
<!--End Js for datepicker-->
<script>
    //check load or refresh page

   /* $(window).on('beforeunload', function () {
        return waringCloseWindow();
    });
    function waringCloseWindow() {
        return 'Bạn có chắc chắn muốn đóng cửa sổ?';
    }*/
</script>