<?php
    /* @var $this AProductsController */
    /* @var $model AProducts */
    /* @var $modelDetail AProductDetail */
    /* @var $modelFiles AFiles */
    /* @var $form CActiveForm */
    /* @var $cate_tree */
?>
<?php
    $tab_class       = '';
    $data_tab_toggle = 'tab';
    $tab2            = '';
    $tab1            = 'active';
    $tab1_content    = 'active in';
    $tab2_content    = '';
    if ($model->isNewReCord) {
        $cate_tree       = AIOTreeFunction::getTreeArray($model->categories_id);
        $tab_class       = 'disabled';
        $data_tab_toggle = '';
    } else {
        $continue = Yii::app()->request->getParam('continue');
        if (isset($continue) && $continue) {
            $tab1         = '';
            $tab2         = 'active';
            $tab2_content = 'active in';
            $tab1_content = '';
        }
    }
?>
<div class="form">
    <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'                   => 'aproducts-form',
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

    <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="<?= $tab1; ?>">
                <a href="#tab_content1" role="tab" data-toggle="tab" aria-expanded="true">
                    <?= Yii::t('adm/label', 'basic_info') ?>
                </a>
            </li>
            <li role="presentation" class="<?= $tab_class; ?> <?= $tab2; ?>">
                <a href="#tab_content2" role="tab" data-toggle="<?= $data_tab_toggle; ?>" aria-expanded="false">
                    <?= Yii::t('adm/label', 'upload_image') ?>
                </a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade <?= $tab1_content; ?>" id="tab_content1">
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->labelEx($modelDetail, 'name', array('class' => 'control-label')); ?>
                                    <?php echo $form->textField($modelDetail, 'name', array('placeholder' => '', 'class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                                    <?php echo $form->error($modelDetail, 'name'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($model, 'code', array('class' => 'control-label')); ?>
                                    <?php echo $form->textField($model, 'code', array('placeholder' => '', 'class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                                    <?php echo $form->error($model, 'code'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($modelDetail, 'size', array('class' => 'control-label')); ?>
                                    <?php echo $form->textField($modelDetail, 'size', array('placeholder' => '', 'class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                                    <?php echo $form->error($modelDetail, 'size'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($modelDetail, 'material', array('class' => 'control-label')); ?>
                                    <?php echo $form->textField($modelDetail, 'material', array('placeholder' => '', 'class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                                    <?php echo $form->error($modelDetail, 'material'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->labelEx($modelDetail, 'price', array('class' => 'control-label')); ?>
                                    <?php echo $form->textField($modelDetail, 'price', array('placeholder' => '', 'class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                                    <?php echo $form->error($modelDetail, 'price'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($model, 'sale_off', array('class' => 'control-label')); ?>
                                    <?php echo $form->textField($model, 'sale_off', array('placeholder' => '', 'class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                                    <?php echo $form->error($model, 'sale_off'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($model, 'sort_order', array('class' => 'control-label')); ?>
                                    <?php echo $form->textField($model, 'sort_order', array('placeholder' => '', 'class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                                    <?php echo $form->error($model, 'sort_order'); ?>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox-nopad">
                                        <label>
                                            <?php echo $form->checkBox($model, 'hot', array('class' => 'flat')) . ' ' . $form->labelEx($model, 'hot'); ?>
                                        </label>
                                    </div>
                                    <?php echo $form->error($model, 'hot'); ?>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox-nopad">
                                        <label>
                                            <?php
                                                if ($model->isNewRecord) {
                                                    echo $form->checkBox($model, 'status', array('checked' => 'checked', 'class' => 'flat')) . ' ' . $form->labelEx($model, 'status');
                                                } else {
                                                    echo $form->checkBox($model, 'status', array('class' => 'flat')) . ' ' . $form->labelEx($model, 'status');
                                                }
                                            ?>
                                        </label>
                                    </div>
                                    <?php echo $form->error($model, 'status'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 0 10px;">

                            <?php echo $form->ckEditorGroup(
                                $modelDetail,
                                'description',
                                array(
                                    'wrapperHtmlOptions' => array(/* 'class' => 'col-sm-5', */
                                    ),
                                    'widgetOptions'      => array(
                                        'editorOptions' => array(
                                            'fullpage'        => 'js:true',
                                            'width'           => '100%',
                                            'resize_maxWidth' => '100%',
                                            'resize_minWidth' => '320',
                                        )
                                    )
                                )
                            ); ?>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <?php $box = $this->beginWidget(
                                'booster.widgets.TbPanel',
                                array(
                                    'title'       => Yii::t('adm/label', 'select_category'),
                                    'headerIcon'  => 'th-list',
                                    'padContent'  => FALSE,
                                    'htmlOptions' => array('class' => 'bootstrap-widget-table')
                                )
                            ); ?>
                            <div style="padding:10px;">
                                <?php
                                    $this->Widget('ext.AIOTree.AIOTree2', array(
                                        'model'          => $model,
                                        'attribute'      => 'categories_id',
                                        'data'           => $cate_tree,
                                        'type'           => 'checkbox',
                                        'parentShow'     => TRUE,
                                        'parentTag'      => 'div',
                                        'parentId'       => 'aiotree_id',
                                        'header'         => '',
                                        'checkAllText'   => Yii::t('adm/actions', 'check_all'),
                                        'selectParent'   => TRUE,
                                        'controlShow'    => FALSE,
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
            <div role="tabpanel" class="tab-pane fade <?= $tab2_content; ?>" id="tab_content2">
                <div class="row">
                    <div class="col-md-3 col-xs-12">
                        <!-- Cropping Preview -->
                        <div class="thumbnail_area">
                            <div class="">
                                <?php
                                    $box = $this->beginWidget(
                                        'booster.widgets.TbPanel',
                                        array(
                                            'title'       => Yii::t('adm/label', 'thumbnail'),
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
                                                $thumb_url = '../uploads/' . $model->thumbnail;
                                            } else {
                                                $thumb_url = '../uploads/upload-icon.jpg';
                                            }

                                            echo $thumb_url != '' ? CHtml::image($thumb_url, '', array('data-toggle' => 'modal', 'data-target' => '.img_thumbnail', 'width' => '40%')) : ''; ?>
                                        <?php echo $form->hiddenField($model, 'thumbnail', array('id' => 'thumbnail_hidden')) ?>
                                    </div>
                                </div>
                                <?php $this->endWidget(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Cropping Preview -->
                    <div class="col-md-9 col-sm-9 col-xs-12">
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
                            echo CHtml::link('<i class="fa fa-plus"></i> ' . Yii::t('adm/label', 'add_file'), '#', array('id' => 'add_file', 'class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '.view-modal-lg'));
                            //list video file
                            $this->renderPartial('_list_file', array('model' => $model, 'modelFiles' => $modelFiles));
                        ?>
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

    <!-- thumbnail modal -->
    <?php $this->renderPartial('_modal_thumbnail', array('model' => $model, 'modelDetail' => $modelDetail, 'modelFiles' => $modelFiles)) ?>
    <!-- thumbnail modal -->
    <!-- add file modal -->
    <?php $this->renderPartial('_form_files', array('model' => $model, 'modelDetail' => $modelDetail, 'modelFiles' => $modelFiles)) ?>

</div><!-- form -->

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fileupload/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fileupload/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fileupload/jquery.fileupload.js"></script>