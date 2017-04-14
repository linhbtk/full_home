<?php
    $this->breadcrumbs = array(
        $this->modelDisplayName => array('admin'),
        $model->name,
    );

    $this->menu = array(
        array('label' => Yii::t('adm/app', 'create') . ' ' . $this->modelDisplayAttribute, 'url' => array('create'), 'linkOptions' => array('class' => 'btn_create')),
        array('label' => Yii::t('adm/app', 'update') . ' ' . $this->modelDisplayAttribute, 'url' => array('update', 'id' => $model->id), 'linkOptions' => array('class' => 'btn_update')),
        array('label' => Yii::t('adm/app', 'delete') . ' ' . $this->modelDisplayAttribute, 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?'), 'linkOptions' => array('class' => 'btn_delete')),
        array('label' => Yii::t('adm/app', 'manage') . ' ' . $this->modelDisplayAttribute, 'url' => array('admin'), 'linkOptions' => array('class' => 'btn_admin')),
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
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <div class="row">
                    <span class="col-md-12">
                        <?php if ($model->thumbnail != '') { ?>
                            <img width="90%" src="../<?= $model->thumbnail ?>" alt="<?= $model->name ?>"/>
                        <?php } else {
                            echo 'No thumbnail yet.';
                        } ?>
                    </span>

                    </div>
                </div>
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <?php $this->widget('booster.widgets.TbDetailView', array(
                        'data'       => $model,
                        'attributes' => array(
                            [
                                'name' => 'id',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->id);
                                }
                            ],
                            [
                                'name' => 'name',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->name);
                                }
                            ],
                            [
                                'name' => 'unsign_name',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->unsign_name);
                                }
                            ],
                            [
                                'name' => 'code',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->code);
                                }
                            ],
                            [
                                'name' => 'short_description',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->short_description);
                                }
                            ],
                            [
                                'name' => 'full_description',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->full_description);
                                }
                            ],
                            [
                                'name' => 'link',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->link);
                                }
                            ],
                            [
                                'name' => 'public_time',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->public_time);
                                }
                            ],
                            [
                                'name' => 'create_time',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->create_time);
                                }
                            ],
                            [
                                'name' => 'type',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->type);
                                }
                            ],
                            [
                                'name' => 'views',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->views);
                                }
                            ],
                            [
                                'name' => 'created_by',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->created_by);
                                }
                            ],
                            [
                                'name' => 'price',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->price);
                                }
                            ],
                            [
                                'name' => 'artist_id',
                                'value'      => function ($data) {
                                    return CHtml::encode($data->artist_name);
                                }
                            ],

                        ),
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</div>
