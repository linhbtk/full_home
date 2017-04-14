<?php $this->renderPartial('//layouts/_social'); ?>
<?php ($this->isMobile) ? $this->renderPartial('//layouts/_slider_mobile', array('stacks' => 1)) : $this->renderPartial('//layouts/_slider', array('stacks' => 1)); ?>
<?php ($this->isMobile) ? $this->renderPartial('//layouts/_slider_mobile', array('stacks' => 2)) : $this->renderPartial('//layouts/_slider', array('stacks' => 2)); ?>
<?php ($this->isMobile) ? $this->renderPartial('//layouts/_slider_mobile', array('stacks' => 3)) : $this->renderPartial('//layouts/_slider', array('stacks' => 3)); ?>
<div class="space_60"></div>
<div class="container">
    <div class="row center">
        <div class="space_30"></div>
        <div class="title_section">
            <?= Yii::t('web/full_home', 'partner'); ?>
        </div>
        <div class="line"><img src="<?= Yii::app()->theme->baseUrl ?>/images/line.png" alt=""></div>
        <div class="space_70"></div>
    </div>
    <div class="row center">
        <div class="partner">
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/partner_1.jpg" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/partner_2.jpg" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/partner_3.jpg" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/partner_4.jpg" alt="">
                </div>
            </div>
        </div>
        <div class="partner">
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/partner_1.jpg" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/partner_2.jpg" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/partner_3.jpg" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/partner_4.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="space_40"></div>