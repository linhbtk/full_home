<?php
    /* @var $this ProductsController */
    /* @var $products WProducts */
    /* @var $keyword */

    $homeLink = '<i class="glyphicon glyphicon-home" style="color: #FFF;margin-right: 10px;"></i><span class="home_link">' . Yii::t('web/full_home', 'homepage') . '</span>';
?>
<?php $this->renderPartial('//layouts/_social'); ?>
<div class="br_top hidden-xs">
    <div class="container">
        <div class="col-md-12">
            <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'       => array(
                        '<span class="link">' . Yii::t('web/full_home', 'search') . '</span>',
                    ),
                    'encodeLabel' => FALSE,
                    'homeLink'    => $homeLink,
                    'separator'   => '<img src="' . Yii::app()->theme->baseUrl . '/images/br.png"/>',
                    'htmlOptions' => array('class' => 'breadcrumb'),
                ));
            ?>
        </div>
    </div>
</div>
<div class="container">
    <?php $this->renderPartial('//layouts/_banner'); ?>
    <div class="product_list">
        <div class="space_30"></div>
        <div class="title_cate">
            <?php echo ($products == NULL) ? Yii::t('web/full_home', 'no_results') : Yii::t('web/full_home', 'results_with_keyword', array('{keyword}' => CHtml::encode($keyword))); ?>
        </div>
        <div class="line_1"></div>
        <div class="space_30 hidden-xs"></div>
        <div class="list col-xs-12">
            <?php
                if ($products) {
                    $this->widget(
                        'booster.widgets.TbThumbnails',
                        array(
                            'dataProvider'     => new CArrayDataProvider($products,
                                array(
                                    'id'         => 'product',
                                    'keyField'   => FALSE,
                                    'pagination' => array(
                                        'pageSize' => 16,
                                        'params'   => array(
                                            'q'                 => '1',
                                            'WProduct[keyword]' => $keyword,
                                        ),
                                    ))),
                            'template'         => "{items} {pager}",
                            'enablePagination' => TRUE,
                            'itemView'         => '_block_product',
//                            'ajaxType'         => 'POST',
                            'emptyText'        => Yii::t('web/full_home', 'no_results'),
                        )
                    );
                }

            ?>
        </div>
        <div class="space_60"></div>
    </div>
</div>
