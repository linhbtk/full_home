<?php
    /* @var $this AProductsController */
    /* @var $model AProducts */
    /* @var $modelDetail AProductDetail */
    /* @var $modelFiles AFiles */

    $this->breadcrumbs = array(
        Yii::t('adm/label', 'products') => array('admin'),
        $modelDetail->name,
    );
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?= Yii::t('adm/label', 'view') ?> #<?php echo $model->id; ?></h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <div class="row">
                    <span class="col-md-12">
                            <img width="90%" src="<?= Yii::app()->params->upload_dir_path . $model->thumbnail ?>"
                                 alt="<?= $modelDetail->name ?>"/>
                    </span>

                    </div>
                </div>
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <?php $this->widget('booster.widgets.TbDetailView', array(
                        'data'       => $model,
                        'attributes' => array(
                            'id',
                            'code',
                            'sort_order',
                            'last_update',
                            'extra_info',
                            'sale_off',
                            'promotion',
                            array(
                                'name'  => 'hot',
                                'type'  => 'raw',
                                'value' => ($model->hot == AProducts::PRODUCT_HOT) ? AProducts::PRODUCT_HOT : '',
                            ),
                            array(
                                'name'  => 'status',
                                'type'  => 'raw',
                                'value' => $model->getStatusLabel($model->status),
                            ),
                        ),
                    )); ?>
                    <?php $this->widget('booster.widgets.TbDetailView', array(
                        'data'       => $modelDetail,
                        'attributes' => array(
                            'name',
                            'size',
                            'material',
                            array(
                                'name'  => 'price',
                                'type'  => 'raw',
                                'value' => number_format($modelDetail->price, 0, "", "."),
                            ),
                            array(
                                'name'  => 'description',
                                'value' => function ($data) {
                                    return CHtml::encode($data->description);
                                }
                            )
                        ),
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</div>

