<?php
    /* @var $this ACategoriesController */
    /* @var $model ACategories */

    $this->breadcrumbs = array(
        Yii::t('adm/book', 'ACategories') => array('admin'),
        $model->name,
    );

    $this->menu = array(
        array('label' => Yii::t('adm/app', 'Update'), 'url' => array('update', 'id' => $model->id)),
        array('label' => Yii::t('adm/book', 'List ACategories'), 'url' => array('admin')),
    );
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo Yii::t('adm/book', 'ACategories') ?>: <?= $model->name ?></h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php $this->widget('booster.widgets.TbDetailView', array(
                        'data'       => $model,
//                        'htmlOptions' => array(
//                            'class' => 'table-bordered table-hover th-right',
//                        ),
                        'attributes' => array(
                            'id',
                            'json_extra_params',
                            'name',
                            array(
                                'name'  => 'parent_id',
                                'value' => function ($data) {
                                    $cat = ACategories::model()->find('id=:id', array('id' => $data->parent_id));
                                    if ($cat) return $cat->name; else return '';
                                }
                            ),
                            'detail',
                            array(
                                'name'  => 'status',
                                'value' => function ($data) {
                                    return ACategories::$arrayStatus[$data->status];
                                }
                            ),
                            array(
                                'name'  => 'thumbnail',
                                'type'  => 'raw',
                                'value' => $model->getImageUrl()
                            ),
                            array(
                                'name'  => 'in_homepage',
                                'value' => function ($data) {
                                    $str = '';
                                    if ($data->in_homepage == 1) $str = 'Có'; else $str = 'Không';

                                    return $str;
                                }
                            ),
                            array(
                                'name'  => 'in_homepage_order',
                                'value' => function ($data) {
                                    return $data->in_homepage_order;
                                }
                            )
                        ),
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</div>