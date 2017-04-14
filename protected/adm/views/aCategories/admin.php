<?php
    /* @var $this ACategoriesController */
    /* @var $model ACategories */

    $this->breadcrumbs = array(
        Yii::t('adm/book', 'ACategories'),
    );


    Yii::app()->clientScript->registerScript('search', "
        $('.search-button').click(function(){
            $('.search-form').toggle();
            return false;
        });
        $('.search-form form').submit(function(){
            $('#acategories-grid').yiiGridView('update', {
                data: $(this).serialize()
            });
            return false;
        });
    ");
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách danh mục</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
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
                <?php endif; ?>
                <div class="pull-right">
                    <?php /*echo CHtml::link('<i class="fa fa-upload"></i> ' . Yii::t('app', 'Import...'), array('/importExcel', 'm' => get_class($model)), array('class' => 'btn btn-primary')); */?>
                    <?php echo CHtml::link('Tạo mới', array('create'), array('class' => 'btn btn-warning')); ?>
                </div>
                <div class="clearfix"></div>

                <?php $this->widget('booster.widgets.TbGridView', array(
                    'id'            => 'acategories-grid',
                    'dataProvider'  => $model->search(),
                    'filter'        => $model,
                    'itemsCssClass' => 'items table-bordered table-striped table-hover responsive-utilities',
                    'columns'       => array(
                        array(
                            'name'        => 'id',
                            'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '70', 'style' => 'text-align:center'),
                        ),
                        array(
                            'name'        => 'thumbnail',
                            'filter'      => FALSE,
                            'type'        => 'raw',
                            'value'       => 'CHtml::link($data->imageUrl, array(\'update\', \'id\' => $data->id))',
                            'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '1%'),
                        ),
                        array(
                            'name'  => 'name',
                            'type'  => 'raw',
                            'value' => 'CHtml::link(CHtml::encode($data->name), array(\'update\', \'id\' => $data->id))',
                        ),
                        array(
                            'name'  => 'parent_id',
                            'value' => function ($data) {
                                $cat = ACategories::model()->find('id=:id', array('id' => $data->parent_id));
                                if ($cat) return $cat->name; else return '';
                            }
                        ),
                        /*'json_extra_params',*/
                        'detail',
                        array(
                            'name'        => 'status',
                            'type'        => 'raw',
                            'value'       => function ($data) {
                                $icon   = $data->status == ACategories::CATEGORY_ACTIVE ? "<i class=\"fa fa-check-circle\"></i>" : "<i class=\"fa fa-times-circle\"></i>";
                                $status = $data->status == ACategories::CATEGORY_ACTIVE ? ACategories::CATEGORY_INACTIVE : ACategories::CATEGORY_ACTIVE;

                                return CHtml::link($icon, "javascript:;", array(
                                    'title'               => '',
                                    'class'               => '',
                                    'data-toggle'         => 'tooltip',
                                    'data-original-title' => 'Thay đổi trạng thái',
                                    'onclick'             => 'changeStatus(' . $data->id . ',' . $status . ');',
                                ));
                            },
                            'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '100', 'style' => 'text-align:center'),
                        ),
                        array(
                            'name'        => 'in_homepage',
                            'type'        => 'raw',
                            'value'       => function ($data) {
                                $icon   = $data->in_homepage == ACategories::CATEGORY_ACTIVE ? "<i class=\"fa fa-check-circle\"></i>" : "<i class=\"fa fa-times-circle\"></i>";
                                $status = $data->in_homepage == ACategories::CATEGORY_ACTIVE ? ACategories::CATEGORY_INACTIVE : ACategories::CATEGORY_ACTIVE;

                                return CHtml::link($icon, "javascript:;", array(
                                    'title'               => '',
                                    'class'               => '',
                                    'data-toggle'         => 'tooltip',
                                    'data-original-title' => 'Thay đổi trạng thái',
                                    'onclick'             => 'changeInHome(' . $data->id . ',' . $status . ');',
                                ));
                            },
                            'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '160', 'style' => 'text-align:center'),
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
            url: '<?=Yii::app()->createUrl('aCategories/changeStatus')?>',
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
    function changeInHome(id, status) {
        $.ajax({
            type: "POST",
            url: '<?=Yii::app()->createUrl('aCategories/changeInHome')?>',
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

