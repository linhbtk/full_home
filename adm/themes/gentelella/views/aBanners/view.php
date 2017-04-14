<?php
    /* @var $this ABannersController */
    /* @var $model ABanners */

    $this->breadcrumbs = array(
        'Quản lý banner' => array('admin'),
        $model->title,
    );

    //    $this->menu = array(
    //        array('label' => Yii::t('adm/artist', 'Create'), 'url' => array('create')),
    //        array('label' => Yii::t('adm/artist', 'Update'), 'url' => array('update', 'id' => $model->id)),
    ////        array('label' => Yii::t('adm/artist', 'Delete'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    //        array('label' => Yii::t('adm/artist', 'Manage'), 'url' => array('admin')),
    //    );

    //    print_r($this->menu);die();

?>
<div id="sidebar">
    <a class="btn btn-primary" href="/citv/adm/index.php?r=aBanners/create">Tạo mới</a>
    <a class="btn btn-primary" href="/citv/adm/index.php?r=aBanners/update&amp;id=<?= CHtml::encode($model->id) ?>">Cập nhật</a>
    <a class="btn btn-primary" href="/citv/adm/index.php?r=aBanners/admin">Quản lý album</a>
</div
<div class="x_panel">
    <div class="x_title">
        <h1>Thông tin banner</h1>
    </div>
    <div class="x_content">
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="row">
                    <span class="col-md-12">
                        <?php if ($model->img_mobile != '') { ?>
                            <img width="90%" src="<?= "../" . $model->img_mobile ?>" alt="<?= $model->title ?>"/>
                        <?php } else {
                            echo 'No thumbnail yet.';
                        } ?>
                    </span>

                </div>
            </div>
            <div class="col-md-10 col-sm-8 col-xs-10">
                <?php $this->widget('booster.widgets.TbDetailView', array(
                    'data'       => $model,
                    'attributes' => array(
                        array(
                            'name'  => 'title',
                            'type'  => 'raw',
                            'value' => CHtml::encode($model->title),
                        ),
                        array(
                            'name'  => 'target_link',
                            'type'  => 'raw',
                            'value' => CHtml::encode($model->target_link),
                        ),
                        array(
                            'name'  => 'sort_order',
                            'value' => CHtml::encode($model->sort_order),
                        ),
                        array(
                            'name'  => 'status',
                            'value' => CHtml::encode($model->getStatusLabel()),
                        ),
                        array(
                            'name'  => 'content_html',
                            'value' => CHtml::encode($model->content_html),
                        ),

                    ),
                )); ?>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#sidebar').css('display', 'block');
    });
</script>

