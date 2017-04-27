<?php
    /* @var $this AAgencyController */
    /* @var $model AAgency */

    $this->breadcrumbs = array(
        Yii::t('adm/label', 'agency') => array('admin'),
        Yii::t('adm/label', 'manage'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/label', 'create'), 'url' => array('create')),
    );
?>
<div class="x_panel">
    <div class="x_title">
        <h2><?= Yii::t('adm/label', 'manage_agency') ?></h2>

        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="pull-right">
            <?php echo CHtml::link(Yii::t('adm/label', 'create'), array('create'), array('class' => 'btn btn-warning')); ?>
        </div>
        <div class="clearfix"></div>

        <div class="message">
            <span class="msg_change_status"></span>
        </div>
        <div class="table-responsive">
            <?php $this->widget('booster.widgets.TbExtendedGridView', array(
                'id'           => 'aagency-grid',
                'dataProvider' => $model->search(),
                'filter'       => $model,
                'type'         => 'bordered condensed striped',
                'columns'      => array(
                    array(
                        'name'        => 'folder_path',
                        'type'        => 'raw',
                        'value'       => '$data->getImageUrl($data->folder_path)',
                        'htmlOptions' => array('width' => '100px'),
                    ),
                    array(
                        'name'        => 'title',
                        'htmlOptions' => array('style' => 'word-break: break-word;vertical-align:middle;'),
                    ),
                    array(
                        'name'        => 'address',
                        'htmlOptions' => array('style' => 'word-break: break-word;vertical-align:middle;'),
                    ),
                    array(
                        'name'        => 'target_link',
                        'htmlOptions' => array('style' => 'word-break: break-word;vertical-align:middle;'),
                    ),
                    array(
                        'name'        => 'sort_order',
                        'htmlOptions' => array('width' => '70px', 'style' => 'text-align: center;vertical-align:middle;'),
                    ),
                    array(
                        'name'        => 'status',
                        'type'        => 'raw',
                        'filter'      => CHtml::activeDropDownList(
                            $model,
                            'status',
                            array(1 => Yii::t('adm/label', 'active'), 0 => Yii::t('adm/label', 'inactive')),
                            array('empty' => Yii::t('adm/label', 'all'), 'class' => 'form-control')
                        ),
                        'value'       => function ($data) {
                            return CHtml::activeDropDownList($data, 'status',
                                array(1 => Yii::t('adm/label', 'active'), 0 => Yii::t('adm/label', 'inactive')),
                                array('class'    => 'form-control',
                                      'onChange' => "js:changeStatus($data->id,this.value)",
                                )
                            );
                        },
                        'htmlOptions' => array('nowrap' => 'nowrap', 'style' => 'width:130px;text-align:center;vertical-align:middle;'),
                    ),
                    array(
                        'class'       => 'booster.widgets.TbButtonColumn',
                        'htmlOptions' => array('width' => '100px', 'style' => 'text-align: center;vertical-align:middle;'),
                    ),
                ),
            )); ?>
        </div>
    </div>
</div>
<script language="javascript">
    function changeStatus(id, status) {
        $.ajax({
            type: "POST",
            url: '<?=Yii::app()->controller->createUrl('aAgency/changeStatus')?>',
            crossDomain: true,
            dataType: 'json',
            data: {id: id, status: status, YII_CSRF_TOKEN: '<?= Yii::app()->request->csrfToken ?>'},
            success: function (result) {
                if (result.status == true) {
                    $('.msg_change_status').addClass('alert-success');
                    $('.msg_change_status').html(result.msg);
                } else {
                    $('.msg_change_status').addClass('alert-danger');
                    $('.msg_change_status').html(result.msg);
                }
                $('.msg_change_status').show('fade', {}, 500);
            }
        });
        setTimeout(function () {
            $(".msg_change_status").hide('fade', {}, 500)
        }, 5000);
    }
</script>