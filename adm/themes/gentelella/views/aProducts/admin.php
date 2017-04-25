<?php
    /* @var $this AProductsController */
    /* @var $model AProducts */

    $this->breadcrumbs = array(
        Yii::t('adm/label', 'products') => array('admin'),
        Yii::t('adm/label', 'manage'),
    );
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?= Yii::t('adm/label', 'list_product') ?></h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="pull-right">
                    <?php echo CHtml::link(Yii::t('adm/label', 'create'), array('create'), array('class' => 'btn btn-warning')); ?>
                </div>
                <div class="clearfix"></div>
                <?php $this->widget('booster.widgets.TbGridView', array(
                    'id'              => 'aproducts-grid',
                    'dataProvider'    => $model->search(),
                    'filter'          => $model,
                    'type'            => 'bordered condensed striped',
                    'afterAjaxUpdate' => 'reinstallDatePicker',
                    'columns'         => array(
                        array(
                            'name'        => 'id',
                            'htmlOptions' => array('style' => 'width:60px;vertical-align:middle;'),
                        ),
                        array(
                            'name'        => 'thumbnail',
                            'filter'      => FALSE,
                            'type'        => 'raw',
                            'value'       => 'CHtml::link($data->imageUrl, array(\'update\', \'id\' => $data->id))',
                            'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '60px'),
                        ),
                        array(
                            'name'        => 'name',
                            'type'        => 'raw',
                            'value'       => 'CHtml::link($data->name, array(\'update\', \'id\' => $data->id))',
                            'htmlOptions' => array('style' => 'min-width:200px;word-break: break-word;vertical-align:middle;'),
                        ),
//                        array(
//                            'name'        => 'categories_id',
//                            'type'        => 'raw',
//                            'value'       => '$data->categoriesName',
//                            'filter'      => CHtml::activeDropDownList(
//                                $model,
//                                'categories_id',
//                                ACategories::getAllCategories(),
//                                array('empty' => Yii::t('adm/label', 'all'), 'class' => 'form-control')
//                            ),
//                            'htmlOptions' => array('style' => 'text-align: center;word-break: break-word;vertical-align:middle;'),
//                        ),
                        array(
                            'name'        => 'code',
                            'htmlOptions' => array('style' => 'word-break: break-word;vertical-align:middle;')
                        ),
                        array(
                            'name'        => 'sort_order',
                            'htmlOptions' => array('style' => 'width:70px;text-align: center;word-break: break-word;vertical-align:middle;')
                        ),
//                        array(
//                            'name'        => 'hot',
//                            'filter'      => FALSE,
//                            'value'       => function ($model) {
//                                $status = $model->hot == AProducts::PRODUCT_HOT ? 0 : AProducts::PRODUCT_HOT;
//                                $this->widget(
//                                    'booster.widgets.TbEditableField',
//                                    array(
//                                        'type'      => 'select2',
//                                        'model'     => $model,
//                                        'attribute' => 'hot', // $model->name will be editable
//                                        'source'    => array('Hot', 'unHot'),
//                                        'onSave'    => 'js: function(e, params) {
//                                            setHot(' . $model->id . ',' . $status . ');
//                                        }',
//                                    )
//                                );
//                            },
//                            'htmlOptions' => array('style' => 'text-align: center;word-break: break-word;vertical-align:middle;')
//                        ),
                        array(
                            'name'        => 'last_update',
                            'value'       => 'date("d/m/Y",strtotime($data->last_update))',
                            'filter'      => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model'          => $model,
                                'attribute'      => 'last_update',
                                'language'       => 'vi',
                                'htmlOptions'    => array(
                                    'class' => 'form-control',
                                    'size'  => '10',
                                ),
                                'defaultOptions' => array(
                                    'showOn'            => 'focus',
                                    'dateFormat'        => 'mm/dd/yy',
                                    'showOtherMonths'   => TRUE,
                                    'selectOtherMonths' => TRUE,
                                    'changeMonth'       => TRUE,
                                    'changeYear'        => TRUE,
                                    'showButtonPanel'   => TRUE,
                                )
                            ), TRUE),
                            'htmlOptions' => array('width' => '110px', 'style' => 'text-align: center;word-break: break-word;vertical-align:middle;'),
                        ),
                        array(
                            'name'        => 'status',
                            'type'        => 'raw',
                            'filter'      => CHtml::activeDropDownList(
                                $model,
                                'status',
                                array(
                                    AProducts::PRODUCT_ACTIVE   => Yii::t('adm/label', 'active'),
                                    AProducts::PRODUCT_INACTIVE => Yii::t('adm/label', 'inactive')
                                ),
                                array('empty' => Yii::t('adm/label', 'all'), 'class' => 'form-control')
                            ),
                            'value'       => function ($data) {
                                $icon   = $data->status == AProducts::PRODUCT_ACTIVE ? "<i class=\"fa fa-check-circle\"></i>" : "<i class=\"fa fa-times-circle\"></i>";
                                $status = $data->status == AProducts::PRODUCT_ACTIVE ? AProducts::PRODUCT_INACTIVE : AProducts::PRODUCT_ACTIVE;

                                return CHtml::link($icon, "javascript:;", array(
                                    'title'               => '',
                                    'class'               => '',
                                    'data-toggle'         => 'tooltip',
                                    'data-original-title' => Yii::t('adm/label', 'change_status'),
                                    'onclick'             => 'changeStatus(' . $data->id . ',' . $status . ');',
                                ));
                            },
                            'htmlOptions' => array('nowrap' => 'nowrap', 'style' => 'width:120px;text-align:center;vertical-align:middle;'),
                        ),
                        array(
                            'class'       => 'booster.widgets.TbButtonColumn',
//                            'template'    => '{view}&nbsp;&nbsp;{update}',
                            'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '1%', 'style' => 'text-align:center;vertical-align:middle;padding:10px'),
                        ),
                    ),
                ));

                    //reinstall datePicker after update ajax
                    Yii::app()->clientScript->registerScript('re-install-date-picker', "
                    function reinstallDatePicker(id, data) {
                        $('#AProducts_last_update').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['vi'],{'dateFormat':'mm/dd/yy'}));
                    }
                ");
                ?>
            </div>
        </div>
    </div>
</div>
<script language="javascript">
    function changeStatus(id, status) {
        $.ajax({
            type: "POST",
            url: '<?=Yii::app()->controller->createUrl('aProducts/changeStatus')?>',
            crossDomain: true,
            dataType: 'json',
            data: {id: id, status: status, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken?>'},
            success: function (result) {
                if (result === true) {
                    $('#aproducts-grid').yiiGridView('update', {
                        data: $(this).serialize()
                    });
                    return false;
                }
            }
        });
    }

    function setHot(id, status) {
        $.ajax({
            type: "POST",
            url: '<?=Yii::app()->controller->createUrl('aProducts/setHot')?>',
            crossDomain: true,
            dataType: 'json',
            data: {id: id, status: status, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken?>'},
            success: function (result) {
                if (result === true) {
                    $('#aproducts-grid').yiiGridView('update', {
                        data: $(this).serialize()
                    });
                    return false;
                }
            }
        });
    }
</script>
