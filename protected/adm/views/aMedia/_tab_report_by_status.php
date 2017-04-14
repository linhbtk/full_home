<?php

    $this->renderPartial('_search', array('model' => $model, 'type' => $type));


    $this->widget('booster.widgets.TbGridView', array(
        //    'id'           => 'amedia-grid',
        'id'           => 'amedia-grid-' . $type,
        'dataProvider' => $model->search(NULL, $type, 1),
//        'filter'       => $model,
//        'itemsTableId' => 'thongsoChung_export',
        'columns'      => array(
            array(
                'header' => '#',
                'value'  => '++$row',
            ),
//            array(
//                'name'        => 'thumbnail',
//                'filter'      => FALSE,
//                'type'        => 'raw',
//                'value'       => 'CHtml::link($data->imageUrl, array(\'update\', \'id\' => $data->id))',
//                'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '120px'),
//            ),
            'name',
            array(
                'name'        => 'code',
//            'filter'      => FALSE,
                'type'        => 'raw',
                'value'       => 'CHtml::link($data->code, array(\'update\', \'id\' => $data->id))',
                'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '100px', 'style' => 'vertical-align:middle;text-align:center;'),
            ),
            array(
                'name'        => 'public_time',
                'filter'      => FALSE,
                'type'        => 'raw',
                'value'       => 'CHtml::link($data->public_time, array(\'update\', \'id\' => $data->id))',
                'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '150px', 'style' => 'vertical-align:middle;'),
            ),
            array(
                'name'        => 'type',
                'filter'      => CHtml::activeDropDownList($model, 'type',
                    $model->getTypeList(),
                    array('class' => 'form-control', 'prompt' => 'Tất cả', 'style' => 'width:100px;')
                ),
                'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '100px', 'style' => 'vertical-align:middle;text-align:center;'),
            ),
            array(
                'name'        => 'views',
                'filter'      => FALSE,
                'type'        => 'raw',
                'value'       => 'CHtml::link($data->views, array(\'update\', \'id\' => $data->id))',
                'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '150px', 'style' => 'vertical-align:middle;text-align:center;'),
            ),
            array(
                'name'        => 'price',
                'filter'      => FALSE,
                'type'        => 'raw',
                'value'       => 'CHtml::link($data->price, array(\'update\', \'id\' => $data->id))',
                'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '50px', 'style' => 'vertical-align:middle;text-align:center;'),
            ),
            array(
                'name'        => 'cp_id',
                'filter'      => FALSE,
                'type'        => 'raw',
                'value'       => function ($model) {
                    return $model->getCpName($model->cp_id);
                },
                'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '150px', 'style' => 'vertical-align:middle;text-align:center;'),
            ),


//        'link',

//            array(
//                'class'             => 'booster.widgets.TbEditableColumn',
//                'name'              => 'status',
//                'filter'            => FALSE,
//                'headerHtmlOptions' => array('style' => 'width: 100px'),
//                'editable'          => array(
//                    'type'    => 'select',
//                    'source'  => array('Ẩn', 2 => 'Chưa duyệt', 10 => 'Duyệt'),
//                    'options' => array(    //custom display
//                        'display' => 'js: function(value, sourceData) {
//                          var selected = $.grep(sourceData, function(o){ return value == o.value; }),
//                              colors = {1: "green", 2: "blue", 3: "red", 4: "gray"};
//                          $(this).text(selected[0].text).css("color", colors[value]);
//                      }'
//                    ),
//
//                    //onsave event handler
//                    'onSave'  => 'js: function(e, params) {
//                             changeStatus($(this).attr("data-pk"),$(this).attr("data-value"),params.newValue);
//                         }',
////                changeStatus($(this).value(),e,params.newValue);
////                changeStatus(' . $model->id . ',' . $model->status . ',params.newValue);
//                    //source url can depend on some parameters, then use js function:
//                    /*
//                    'source' => 'js: function() {
//                         var dob = $(this).closest("td").next().find(".editable").text();
//                         var username = $(this).data("username");
//                         return "?r=site/getStatuses&user="+username+"&dob="+dob;
//                    }',
//                    'htmlOptions' => array(
//                        'data-username' => '$data->user_name'
//                    )
//                    */
//                ),
//                'htmlOptions'       => array('nowrap' => 'nowrap', 'width' => '100px', 'style' => 'vertical-align:middle;text-align:center;'),
//            ),
//        array(
//            'name'        => 'status',
//            'filter'      => FALSE,
//            'value'       => function ($model) {
//               $this->widget(
//                    'booster.widgets.TbEditableField',
//                    array(
//                        'type'      => 'select2',
//                        'model'     => $model,
//                        'attribute' => 'status', // $model->name will be editable
//                        'source'    => array('Ẩn', 2 => 'Chưa duyệt', 10 => 'Duyệt'),
//                        'onSave'    => 'js: function(e, params) {
//                               changeStatus(' . $model->id . ',' . $model->status . ',params.newValue);
//                         }',
//                    )
//                );
//
//
//            },
//            'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '100px', 'style' => 'vertical-align:middle;text-align:center;'),
//        ),
//            array(
//                'header'      => 'Xem File',
//                'type'        => 'raw',
//                'value'       => function ($data) {
//                    $video_url = $data->createUrl('web', FALSE);
//                    $return    = $data->checkFileStatus();
//                    if ($return == 1) {
//                        $disable = array();
//
//                        return CHtml::activeDropDownList($data, 'status', AMedia::model()->getListQuality($data->id),
//                            array(
//                                'class'       => 'form-control',
//                                'data-toggle' => 'modal',
//                                'id'          => 'AMedia_status_' . $data->id,
//                                //'onChange'    => 'js:jwplayer("jwplayer_video_admin").setup({sources: [{file: "' . $video_url . '"}], width: "100%"});',
//                                'onChange'    => 'ajaxViewVideo("' . $data->id .'")',
//                                'options'     => $disable
//                            ));
//                    } else {
//                        return $return;
//                    }
//
//                },
//                'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '150px', 'style' => 'vertical-align:middle;text-align:center;'),
//            ),
//                array(
//                    'name'        => 'status',
//                    'filter'      => FALSE,
//                    'type'        => 'raw',
//                    'value'       => function ($data) {
//                        $disable = array();
//
//                        return CHtml::activeDropDownList($data, 'status', AMedia::model()->getStatusList(),
//                            array(
//                                'class'    => 'form-control',
//                                'onChange' => "js:changeStatus($data->id,$data->status,this.value)",
//                                'options'  => $disable
//                            ));
//                    },
//                    'htmlOptions' => array('width' => '150px', 'style' => 'vertical-align:middle;'),
//                ),
//        array(
//            'name'   => 'is_hot',
//            'filter' => FALSE,
//            'value'  => function ($model) {
//                $icon   = $model->is_hot == AMedia::IS_HOT ? "<i class=\"fa fa-check-circle\"></i>" : "<i class=\"fa fa-times-circle\"></i>";
//                $status = $model->is_hot == AMedia::IS_HOT ? 0 : AMedia::IS_HOT;
//                $this->widget(
//                    'booster.widgets.TbEditableField',
//                    array(
//                        'type'      => 'select2',
//                        'model'     => $model,
//                        'attribute' => 'is_hot', // $model->name will be editable
//                        'source'    => array('Hot','unHot'),
//                        'onSave'    => 'js: function(e, params) {
//                               setHot(' . $model->id . ',' . $status . ',"amedia-grid-' . $model->status . '");
//                         }',
//                    )
//                );
//            }
//        ),
            array(
                'name'        => 'is_hot',
                'type'        => 'raw',
                'filter'      => FALSE,
                'value'       => function ($data) {
                    $icon   = $data->is_hot == AMedia::IS_HOT ? "<i class=\"fa fa-check-circle\"></i>" : "<i class=\"fa fa-times-circle\"></i>";
                    $status = $data->is_hot == AMedia::IS_HOT ? 0 : AMedia::IS_HOT;

                    return CHtml::link($icon, "javascript:;", array(
                        'title'               => '',
                        'class'               => '',
                        'data-toggle'         => 'tooltip',
                        'data-original-title' => 'Đánh dấu là Hot',
                        'onclick'             => 'setHot(' . $data->id . ',' . $status . ',"amedia-grid-' . $data->status . '");',
                    ));
                },
                'htmlOptions' => array('width' => '50px', 'style' => 'vertical-align:middle;text-align:center;'),
            ),
            /*
            'views',
            'short_description',
            'approved_by',
            'price',
            'cp_id',
            'artist_id',
            'album_id',
            'last_update',
            'extra_info',
            'status',
            */
//            array(
//                'class'       => 'booster.widgets.TbButtonColumn',
//                'template' =>'{view}',
//                'htmlOptions' => array('style' => 'width:100px;vertical-align:middle;text-align:center;'),
//            ),
        ),
    )); ?>

<script>
    $(document).ready(function () {
        $('#amedia-grid-<?= $type?>').children(".items").attr("id", "amedia-table-<?= $type?>");
        $("#export-excel_<?=$type?>").on('click', function () {
            var uri = $("#amedia-table-<?= $type?>").battatech_excelexport({
                containerid: "amedia-table-<?= $type?>"
                , worksheetName: 'Thống kê lượt view'
                , datatype: 'table'
                , returnUri: true
            });

            $(this).attr('download', '<?='Thống kê lượt view'?>.xls').attr('href', uri).attr('target', '_blank');
        });

    });
</script>