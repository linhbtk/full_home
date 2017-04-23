<?php
    /* @var $this ABannersController */
    /* @var $model ABanners */
    /* @var $type */
?>
<div class="table-responsive">
    <?php
        if ($type) {
            $this->widget('booster.widgets.TbGridView', array(
                'id'           => 'abanners-grid-' . $type,
                'dataProvider' => $model->search($type),
                'filter'       => $model,
                'columns'      => array(
                    array(
                        'name'        => 'img_desktop',
                        'filter'      => FALSE,
                        'type'        => 'raw',
                        'value'       => 'CHtml::link($data->getImageUrl($data->img_desktop), array(\'update\', \'id\' => $data->id))',
                        'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '1%'),
                    ),
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
                        'htmlOptions' => array('width' => '90px', 'style' => 'text-align: center;'),
                    ),
                    array(
                        'name'        => 'stacks',
                        'filter'      => CHtml::activeDropDownList(
                            $model,
                            'stacks',
                            $model->getListBannerStacks(),
                            array('empty' => Yii::t('adm/label', 'all'), 'class' => 'form-control')
                        ),
                        'type'        => 'raw',
                        'value'       => function ($data) {
                            return $data->getBannerStacksLabel();
                        },
                        'htmlOptions' => array('width' => '150px', 'style' => 'text-align:center;vertical-align:middle;word-break: break-word;'),
                    ),
                    array(
                        'name'        => 'status',
                        'filter'      => CHtml::activeDropDownList(
                            $model,
                            'status',
                            array(
                                ABanners::BANNER_ACTIVE   => Yii::t('adm/label', 'active'),
                                ABanners::BANNER_INACTIVE => Yii::t('adm/label', 'inactive')
                            ),
                            array('empty' => Yii::t('adm/label', 'all'), 'class' => 'form-control')
                        ),
                        'type'        => 'raw',
                        'value'       => function ($data) {
                            return CHtml::activeDropDownList($data, 'status',
                                array(
                                    ABanners::BANNER_ACTIVE   => Yii::t('adm/label', 'active'),
                                    ABanners::BANNER_INACTIVE => Yii::t('adm/label', 'inactive')
                                ),
                                array('class'    => 'form-control',
                                      'onChange' => "js:changeStatus($data->id,this.value)",
                                )
                            );
                        },
                        'htmlOptions' => array('width' => '130px', 'style' => 'vertical-align:middle;'),
                    ),
                    array(
                        'class'       => 'booster.widgets.TbButtonColumn',
                        'template'    => '{update}&nbsp;&nbsp;{delete}',
                        'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '1%', 'style' => 'text-align:center;vertical-align:middle;padding:10px'),
                    ),
                ),
            ));
        } else {
            $this->widget('booster.widgets.TbGridView', array(
                'id'           => 'abanners-grid',
                'dataProvider' => $model->search(),
                'filter'       => $model,
                'columns'      => array(
                    array(
                        'name'        => 'img_desktop',
                        'filter'      => FALSE,
                        'type'        => 'raw',
                        'value'       => 'CHtml::link($data->getImageUrl($data->img_desktop), array(\'update\', \'id\' => $data->id))',
                        'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '1%'),
                    ),
                    array(
                        'name'        => 'img_mobile',
                        'filter'      => FALSE,
                        'type'        => 'raw',
                        'value'       => 'CHtml::link($data->getImageUrl($data->img_mobile), array(\'update\', \'id\' => $data->id))',
                        'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '1%'),
                    ),
                    array(
                        'name'        => 'title',
                        'type'        => 'raw',
                        'value'       => 'CHtml::link(CHtml::encode($data->title), array(\'update\', \'id\' => $data->id))',
                        'htmlOptions' => array('style' => 'vertical-align:middle;word-break: break-word;'),
                    ),
                    array(
                        'name'        => 'type',
                        'filter'      => CHtml::activeDropDownList(
                            $model,
                            'type',
                            $model->getListBannerType(),
                            array('empty' => Yii::t('adm/label', 'all'), 'class' => 'form-control')
                        ),
                        'type'        => 'raw',
                        'value'       => function ($data) {
                            return $data->getBannerTypeLabel();
                        },
                        'htmlOptions' => array('width' => '150px', 'style' => 'text-align:center;vertical-align:middle;word-break: break-word;'),
                    ),
                    array(
                        'name'        => 'sort_order',
                        'htmlOptions' => array('width' => '90px', 'style' => 'text-align:center;vertical-align:middle;'),
                    ),
                    array(
                        'name'        => 'stacks',
                        'filter'      => CHtml::activeDropDownList(
                            $model,
                            'stacks',
                            $model->getListBannerStacks(),
                            array('empty' => Yii::t('adm/label', 'all'), 'class' => 'form-control')
                        ),
                        'type'        => 'raw',
                        'value'       => function ($data) {
                            return $data->getBannerStacksLabel();
                        },
                        'htmlOptions' => array('width' => '150px', 'style' => 'text-align:center;vertical-align:middle;word-break: break-word;'),
                    ),
                    array(
                        'name'        => 'status',
                        'filter'      => CHtml::activeDropDownList(
                            $model,
                            'status',
                            array(
                                ABanners::BANNER_ACTIVE   => Yii::t('adm/label', 'active'),
                                ABanners::BANNER_INACTIVE => Yii::t('adm/label', 'inactive')
                            ),
                            array('empty' => Yii::t('adm/label', 'all'), 'class' => 'form-control')
                        ),
                        'type'        => 'raw',
                        'value'       => function ($data) {
                            return CHtml::activeDropDownList($data, 'status',
                                array(
                                    ABanners::BANNER_ACTIVE   => Yii::t('adm/label', 'active'),
                                    ABanners::BANNER_INACTIVE => Yii::t('adm/label', 'inactive')
                                ),
                                array('class'    => 'form-control',
                                      'onChange' => "js:changeStatus($data->id,this.value)",
                                )
                            );
                        },
                        'htmlOptions' => array('width' => '130px', 'style' => 'vertical-align:middle;'),
                    ),
                    array(
                        'class'       => 'booster.widgets.TbButtonColumn',
                        'template'    => '{update}&nbsp;&nbsp;{delete}',
                        'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '1%', 'style' => 'text-align:center;vertical-align:middle;padding:10px'),
                    ),
                ),
            ));
        } ?>
</div>
<script language="javascript">
    function changeStatus(id, status) {
        if (confirm('Bạn muốn thay đổi trạng thái?')) {
            $.ajax({
                type: "POST",
                url: '<?=Yii::app()->controller->createUrl('aBanners/changeStatus')?>',
                crossDomain: true,
                dataType: 'json',
                data: {id: id, status: status},
                success: function (result) {
                    $('#abanners-grid').yiiGridView('update', {
                        data: $(this).serialize()
                    });
                    $('#abanners-grid-banner').yiiGridView('update', {
                        data: $(this).serialize()
                    });
                    $('#abanners-grid-slider').yiiGridView('update', {
                        data: $(this).serialize()
                    });
                    return false;
                }
            });
        }
    }
</script>