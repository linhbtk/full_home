<?php
    /* @var $this AUsersController */
    /* @var $model AUsers */

    $this->breadcrumbs = array(
        'Ausers' => array('index'),
        'Manage',
    );


    Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ausers-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile(Yii::app()->baseUrl . '/themes/gentelella/js/jquery.battatech.excelexport.js');
?>

<div class="x_panel">
    <div class="x_title">
        <h1>Tổng số lượt xem</h1>
    </div>
    <div class="clearfix"></div>

    <?=
        $this->renderPartial('_search', array('model' => $model));
    ?>
    <div class="x_content">
        <?php $this->widget('booster.widgets.TbGridView', array(
            'id'            => 'ausers-grid',
            'dataProvider'  => $model->search(),
//            'filter'        => $model,
            'itemsCssClass' => 'items table-bordered table-striped table-hover responsive-utilities album-artist-parent',
            'columns'       => array(
                array(
                    'name'        => 'username',
                    'filter'      => FALSE,
                    'type'        => 'raw',
                    'value'       => 'CHtml::encode($data->username)',
                    'htmlOptions' => array('style' => 'text-align:center;vertical-align:middle;text-align:center;'),
                ),
                array(
                    'name'        => 'status',
                    'filter'      => FALSE,
                    'type'        => 'raw',
                    'value'       => function ($model) {
                        if ($model->status == 1) {
                            return 'Đang hoạt động';
                        } else {
                            return 'Đã chặn';
                        }
                    },
                    'htmlOptions' => array('style' => 'text-align:center;vertical-align:middle;text-align:center;'),
                ),
                array(
                    'name'        => 'total_upload',
                    'filter'      => FALSE,
                    'type'        => 'raw',
                    'value'       => 'CHtml::encode($data->total_upload)',
                    'htmlOptions' => array('style' => 'text-align:center;vertical-align:middle;text-align:center;'),
                ),
                array(
                    'name'        => 'total_views',
                    'filter'      => FALSE,
                    'type'        => 'raw',
                    'value'       => 'CHtml::encode($data->total_views)',
                    'htmlOptions' => array('style' => 'text-align:center;vertical-align:middle;text-align:center;'),
                ),
//                'password',
//                'email',
//                'activkey',
//                'createtime',
//                /*
//                'lastvisit',
//                'superuser',

//                'parent_id',
//
//                array(
//                    'class'       => 'booster.widgets.TbButtonColumn',
//
//                    'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '80px', 'style' => 'text-align:center;vertical-align:middle;padding:10px'),
//                ),
            ),
        )); ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('table').attr("id", "auser-table");
        var date_from = $('#AUsers_datefrom').val();
        var date_to = $('#AUsers_dateto').val();
        $("#export-excel_cps_total").on('click', function () {
            var uri = $("#auser-table").battatech_excelexport({
                containerid: "auser-table"
                , worksheetName: 'Thống kê lượt upload'
                , datatype: 'table'
                , returnUri: true
            });
            var name_excel = '';
            if (date_from != '' && date_to != '') {
                name_excel = 'Thống kê tổng số view từ ' + date_from + '. đến ' + date_to + '.xls';
            } else {
                name_excel = 'Thống kê tổng số view.xls';
            }
            $(this).attr('download', name_excel).attr('href', uri).attr('target', '_blank');
        });

    });
</script>
