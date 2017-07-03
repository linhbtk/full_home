<?php
    /* @var $this SiteController */
    /* @var $partners WPartners */
?>
<?php $this->renderPartial('//layouts/_social'); ?>
<div id="slider_1">
    <?php $this->renderPartial('//layouts/_slider', array('stacks' => WBanners::STACK_1)); ?>
</div>
<div id="slider_2">
    <?php $this->renderPartial('//layouts/_slider', array('stacks' => WBanners::STACK_2)); ?>
</div>
<div id="slider_3">
    <?php $this->renderPartial('//layouts/_slider', array('stacks' => WBanners::STACK_3)); ?>
</div>
<div class="space_60"></div>
<div class="container">
    <div class="row text-center">
        <div class="space_30"></div>
        <div class="title_section">
            <?= Yii::t('web/full_home', 'partner'); ?>
        </div>
        <div class="line"><img src="<?= Yii::app()->theme->baseUrl ?>/images/line.png" alt=""></div>
        <div class="space_70"></div>
    </div>
    <div class="row text-center">
        <div class="partner">
            <?php
                if ($partners && is_array($partners)):
                    foreach ($partners as $item):
                        ?>
                        <div class="col-md-3 col-xs-6">
                            <a href="<?= $item->target_link ?>" title="<?= CHtml::encode($item->title); ?>">
                                <div class="thumbnail">
                                    <img src="<?= Yii::app()->params->upload_dir . $item->folder_path; ?>" alt="">
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
        </div>
    </div>
</div>
<div class="space_40"></div>