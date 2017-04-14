<?php
    /* @var $this ABannersController */
    /* @var $model ABanners */
?>
<div class="table-responsive">
    <?php
        $this->widget('booster.widgets.TbGridView', array(
            'id'           => 'abanners-grid-' . $status,
            'dataProvider' => $model->search($status),
            'filter'       => $model,
            'columns'      => array(
                array(
                    'name'        => 'img_mobile',
                    'filter'      => FALSE,
                    'type'        => 'raw',
                    'value'       => 'CHtml::link($data->getImageUrl($data->img_mobile), array(\'update\', \'id\' => $data->id))',
                    'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '1%'),
                ),
                array(
                    'name'  => 'title',
                    'type'  => 'raw',
                    'value' => 'CHtml::link(CHtml::encode($data->title), array(\'update\', \'id\' => $data->id))',
                ),
                array(
                    'name'        => 'sort_order',
                    'filter'      => FALSE,
                    'htmlOptions' => array('width' => '200px', 'style' => 'text-align: center;'),
                ),
                array(
                    'name'        => 'status',
                    'filter'      => FALSE,
                    'type'        => 'raw',
                    'value'       => function ($data) {
                        return CHtml::activeDropDownList($data, 'status',
                            array(1 => 'Kích hoạt', 0 => 'Ẩn'),
                            array('class'    => 'form-control',
                                  'onChange' => "js:changeStatus($data->id,this.value)",
                            )
                        );
                    },
                    'htmlOptions' => array('width' => '130px', 'style' => 'vertical-align:middle;'),
                ),
                array(
                    'class'       => 'booster.widgets.TbButtonColumn',
                    'template'    => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}',
                    'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '1%', 'style' => 'text-align:center;vertical-align:middle;padding:10px'),
                ),
            ),
        ));
    ?>
</div>
<script language="javascript">
    function changeStatus(id, status) {
        if (confirm('Bạn muốn thay đổi trạng thái?')) {
            $.ajax({
                type: "POST",
                url: '<?=Yii::app()->createUrl('ABanners/changeStatus')?>',
                crossDomain: true,
                dataType: 'json',
                data: {id: id, status: status},
                success: function (result) {
                    if (result == true) {
                        alert('Cập nhật trạng thái thành công.');
                    } else {
                        alert('Cập nhật trạng thái không thành công.');
                    }
                }
            });
        }
        window.location.reload(true);
    }

    //    function changeStatus(id, status) {
    //        if (confirm('Bạn muốn thay đổi trạng thái?')) {
    //            $.ajax({
    //                type: "POST",
    //                url: '<?//=Yii::app()->createUrl('ABanners/changeStatus')?>//',
    //                crossDomain: true,
    //                dataType: 'json',
    //                data: {id: id, status: status},
    //                success: function (result) {
    //                    $.fn.yiiGridView.update('abanners-grid');
    //                    $.fn.yiiGridView.update('abanners-grid-'+'<?//=ABanners::VIETTEL_TELCO?>//');
    //                    $.fn.yiiGridView.update('abanners-grid-'+'<?//=ABanners::VINAPHONE_TELCO?>//');
    //                    if (result == true) {
    //                        alert('Cập nhật trạng thái thành công.');
    //                    } else {
    //                        alert('Cập nhật trạng thái không thành công.');
    //                    }
    //                }
    //            });
    //        }
    //    }
</script>