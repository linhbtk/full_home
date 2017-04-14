<?php
    /* @var $this ImportExcelController */
    /* @var $model APublishings */
    /* @var $modelName */
    /* @var $url_redirect */

    if ($url_redirect) {
        $this->breadcrumbs = array(
            Yii::t('adm/actions', 'manage') => $url_redirect,
            'Import',
        );

    } else {
        $this->breadcrumbs = array(
            Yii::t('adm/book', $modelName) => array('/' . lcfirst($modelName) . '/admin'),
            'Import',
        );

    }

?>

<?php if($model):?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Import dữ liệu từ Excel</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="form" id="crop-avatar">

                        <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
                            'id'                   => 'aauthors-form',
                            // Please note: When you enable ajax validation, make sure the corresponding
                            // controller action is handling ajax validation correctly.
                            // There is a call to performAjaxValidation() commented in generated controller code.
                            // See class documentation of CActiveForm for details on this.
                            'enableAjaxValidation' => FALSE,
                            'htmlOptions'          => array('enctype' => 'multipart/form-data', 'class' => 'avatar-form')
                        )); ?>
                        <div>
                            <?php if (Yii::app()->user->hasFlash('error')): ?>
                                <div role="alert" class="alert alert-danger alert-dismissible fade in">
                                    <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <?php echo Yii::app()->user->getFlash('error'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (Yii::app()->user->hasFlash('success')): ?>
                                <div role="alert" class="alert alert-info alert-dismissible fade in">
                                    <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <?php echo Yii::app()->user->getFlash('success'); ?>
                                </div>
                            <?php else: ?>
                                <div class="form-group">
                                    <?php
                                        echo CHtml::link('<i class="fa fa-download"></i> ' . 'Download định dạng file Excel mẫu', array('/aImportExcel/excelTemplate', 'm' => $modelName), array('class' => 'btn btn-warning'));
                                    ?>
                                </div>

                                <div class="form-group">
                                    <label>Chọn file cần Import (.xls, .xlsx)</label>
                                    <?php echo $form->fileField($model, 'filename', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                                    <?php echo $form->error($model, 'filename'); ?>
                                </div>

                                <div class="form-group">
                                    <?php echo CHtml::submitButton('Import', array('class' => 'btn btn-success')); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php $this->endWidget(); ?>
                    </div><!-- form -->
                </div>
            </div>
        </div>
    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications">
            <?php
                if (isset(Yii::app()->session['userView' . Yii::app()->user->id . 'returnURL']))
                    echo CHtml::link('<i class="fa fa-backward"></i> ' . 'Quay lại', Yii::app()->session['userView' . Yii::app()->user->id . 'returnURL'], array('class' => 'btn btn-warning'));
                else
                    echo CHtml::link('<i class="fa fa-backward"></i> ' . 'Quay lại', array('/'), array('class' => 'btn btn-warning'));
            ?>
        </div>
    </div>
<?php endif;?>