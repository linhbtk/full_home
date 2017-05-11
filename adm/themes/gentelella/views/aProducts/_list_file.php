<?php
    /* @var $model AProducts */
    /* @var $modelDetail AProductDetail */
    /* @var $modelFiles AFiles */
?>
<?php $this->widget('booster.widgets.TbGridView', array(
    'id'              => 'files-grid',
    'type'            => 'bordered condensed striped',
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'dataProvider'    => $modelFiles->search($model->id),
    'columns'         => array(
        array(
            'header'      => Yii::t('adm/label', 'row_number'),
            'type'        => 'raw',
            'value'       => function ($data, $row) {
                return ++$row . '<input name="product_"' . $data->id . '" id="product_"' . $data->id . '" type="hidden" value="' . $data->id . '">';
            },
            'htmlOptions' => array('width' => 70, 'style' => 'vertical-align:middle;')
        ),
        array(
            'name'        => 'folder_path',
            'filter'      => FALSE,
            'type'        => 'raw',
            'value'       => '$data->imageUrl',
            'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '100', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
        array(
            'name'        => 'file_ext',
            'value'       => '".".$data->file_ext',
            'htmlOptions' => array('style' => 'vertical-align:middle;')
        ),
        array(
            'name'        => 'file_size',
            'value'       => 'AFunction::formatSizeUnits($data->file_size)',
            'htmlOptions' => array('style' => 'vertical-align:middle;')
        ),
        array(
            'class'       => 'booster.widgets.TbEditableColumn',
            'name'        => 'sort_order',
            'sortable'    => FALSE,
            'editable'    => array(
                'url'        => $this->createUrl('aFiles/editableSortOrder'),
                'placement'  => 'right',
                'inputclass' => 'span3'
            ),
            'htmlOptions' => array('style' => 'text-align: center;vertical-align: middle;'),
        ),
        array(
            'name'        => 'extra_info',
            'type'        => 'raw',
            'value'       => function ($data) {
                return CHtml::activeDropDownList($data, 'extra_info',
                    $data->getAllTypeContent(),
                    array('class'    => 'form-control',
                          'prompt' => Yii::t('adm/label','select_type_content'),
                          'onChange' => "js:changeExtraInfo($data->id,this.value)",
                    )
                );
            },
            'htmlOptions' => array('width' => '130px', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
        array(
            'name'        => 'upload_time',
            'value'       => 'date("d/m/Y",strtotime($data->upload_time))',
            'filter'      => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'          => $modelFiles,
                'attribute'      => 'upload_time',
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
            'htmlOptions' => array('width' => '100px', 'style' => 'text-align: center;word-break: break-word;vertical-align:middle;'),
        ),
        array(
            'header'      => Yii::t('adm/label', 'file_status'),
            'type'        => 'raw',
            'value'       => function ($data) {
                //Check File Exist
                $file_path = Yii::app()->params->upload_dir_path . $data->folder_path;
                if (is_file($file_path) && file_exists($file_path)) {
                    return CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/tick.png');
                } else {
                    return CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/publish_x.png');
                }
            },
            'htmlOptions' => array('style' => 'width:130px;vertical-align:middle;text-align:center;')
        ),
        array(
            'header'      => Yii::t('adm/label', 'delete'),
            'type'        => 'raw',
            'value'       => function ($data) {
                return CHtml::link(
                    '<i class="glyphicon glyphicon-trash"></i>',
                    $this->createUrl('aFiles/delete', array('id' => $data->id))
                );
            },
            'htmlOptions' => array('width' => '30px', 'style' => 'vertical-align:middle;'),
        ),
    ),
));
    //reinstall datePicker after update ajax
    Yii::app()->clientScript->registerScript('re-install-date-picker', "
        function reinstallDatePicker(id, data) {
            $('#AFiles_upload_time').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['vi'],{'dateFormat':'mm/dd/yy'}));
        }
    ");
?>
<script language="javascript">
    function changeExtraInfo(id, value) {
        bootbox.confirm("<?=Yii::t('adm/label', 'confirm_change_extra_info')?>", function (confirmed) {
            if (confirmed == true) {
                $.ajax({
                    type: "POST",
                    url: '<?=Yii::app()->controller->createUrl('aFiles/changeExtraInfo')?>',
                    crossDomain: true,
                    dataType: 'json',
                    data: {id: id, value: value, YII_CSRF_TOKEN: '<?= Yii::app()->request->csrfToken ?>'},
                    success: function (result) {
                        $.fn.yiiGridView.update('files-grid');
                        bootbox.alert(result.msg);
                    }
                });
            } else {
                $.fn.yiiGridView.update('files-grid');
            }
        });
    }
</script>