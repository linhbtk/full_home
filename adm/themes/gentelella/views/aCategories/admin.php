<?php
    /* @var $this ACategoriesController */
    /* @var $model ACategories */

    $this->breadcrumbs = array(
        Yii::t('adm/label', 'categories') => array('admin'),
        Yii::t('adm/label', 'manage'),
    );
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?= Yii::t('adm/label', 'list_categories') ?></h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="pull-right">
                    <?php echo CHtml::link(Yii::t('adm/label', 'create'), array('create'), array('class' => 'btn btn-warning')); ?>
                </div>
                <div class="clearfix"></div>

                <?php $this->widget('booster.widgets.TbGridView', array(
                    'id'           => 'acategories-grid',
                    'dataProvider' => $model->search(),
                    'filter'       => $model,
                    'columns'      => array(
                        array(
                            'name'        => 'id',
                            'htmlOptions' => array('style' => 'width:100px;vertical-align:middle;'),
                        ),
                        array(
                            'name'        => 'thumbnail',
                            'filter'      => FALSE,
                            'type'        => 'raw',
                            'value'       => 'CHtml::link($data->imageUrl, array(\'update\', \'id\' => $data->id))',
                            'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '1%'),
                        ),
                        array(
                            'name'        => 'name',
                            'type'        => 'raw',
                            'value'       => 'CHtml::link($data->name, array(\'update\', \'id\' => $data->id))',
                            'htmlOptions' => array('style' => 'min-width:200px;word-break: break-word;vertical-align:middle;'),
                        ),
                        array(
                            'name'        => 'parent_id',
                            'type'        => 'raw',
                            'value'       => '$data->parentName',
                            'filter'      => CHtml::activeDropDownList(
                                $model,
                                'parent_id',
                                ACategories::getAllCategories(),
                                array('empty' => Yii::t('adm/label', 'all'), 'class' => 'form-control')
                            ),
                            'htmlOptions' => array('style' => 'text-align: center;word-break: break-word;vertical-align:middle;'),
                        ),
                        array(
                            'name'        => 'sort_order',
                            'htmlOptions' => array('style' => 'width:100px;text-align: center;vertical-align:middle;'),
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
                                $icon   = $data->status == ACategories::CATEGORY_ACTIVE ? "<i class=\"fa fa-check-circle\"></i>" : "<i class=\"fa fa-times-circle\"></i>";
                                $status = $data->status == ACategories::CATEGORY_ACTIVE ? ACategories::CATEGORY_INACTIVE : ACategories::CATEGORY_ACTIVE;

                                return CHtml::link($icon, "javascript:;", array(
                                    'title'               => '',
                                    'class'               => '',
                                    'data-toggle'         => 'tooltip',
                                    'data-original-title' => Yii::t('adm/label', 'change_status'),
                                    'onclick'             => 'changeStatus(' . $data->id . ',' . $status . ');',
                                ));
                            },
                            'htmlOptions' => array('nowrap' => 'nowrap', 'style' => 'width:130px;text-align:center;vertical-align:middle;'),
                        ),
                        array(
                            'class'       => 'booster.widgets.TbButtonColumn',
                            'template'    => '{update}&nbsp;&nbsp;{delete}',
                            'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '1%', 'style' => 'text-align:center;vertical-align:middle;padding:10px'),
                        ),
                    ),
                )); ?>
            </div>
        </div>
    </div>
</div>
<script language="javascript">
    function changeStatus(id, status) {
        $.ajax({
            type: "POST",
            url: '<?=Yii::app()->controller->createUrl('aCategories/changeStatus')?>',
            crossDomain: true,
            dataType: 'json',
            data: {id: id, status: status, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken?>'},
            success: function (result) {
                if (result === true) {
                    $('#acategories-grid').yiiGridView('update', {
                        data: $(this).serialize()
                    });
                    return false;
                }
            }
        });
    }
</script>
