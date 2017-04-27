<?php
    /* @var $this SiteController */
    /* @var $model ContactForm */
    /* @var $form CActiveForm */
?>
<div class="br_top hidden-xs">
    <div class="container">
        <div class="col-md-12">
            <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'       => array(
                        '<span class="home_link">' . Yii::t('web/full_home', 'contact') . '</span>'
                    ),
                    'encodeLabel' => FALSE,
                    'homeLink'    => '',
                    'separator'   => '',
                    'htmlOptions' => array('class' => 'breadcrumb'),
                ));
            ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="contact">
        <?php $this->widget('booster.widgets.TbAlert'); ?>
        <div class="space_40"></div>
        <div class="col-md-6 col-xs-12 xs_no_pad">
            <p class="uppercase info"><?= Yii::t('web/full_home', 'company_name') ?></p>

            <p class="info"><?= Yii::t('web/full_home', 'address') ?></p>

            <p class="info"><?= Yii::t('web/full_home', 'phone_number') ?></p>
        </div>
        <div class="xs_space_20"></div>
        <div class="col-md-6 col-xs-12">
            <div class="form">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id'                   => 'contact-form',
                    'action'               => Yii::app()->controller->createAbsoluteUrl("site/contact"),
                    'enableAjaxValidation' => TRUE,
                )); ?>
                <div class="form-group">
                    <?php echo $form->textField($model, 'name', array('placeholder' => Yii::t('web/full_home', 'name'), 'class' => 'form-control', 'size' => 45)); ?>
                    <?php echo $form->error($model, 'name'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->textField($model, 'email', array('placeholder' => Yii::t('web/full_home', 'email'), 'class' => 'form-control', 'size' => 45)); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->textField($model, 'company', array('placeholder' => Yii::t('web/full_home', 'company'), 'class' => 'form-control', 'size' => 45)); ?>
                    <?php echo $form->error($model, 'company'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->textField($model, 'subject', array('placeholder' => Yii::t('web/full_home', 'subject'), 'class' => 'form-control', 'size' => 45)); ?>
                    <?php echo $form->error($model, 'subject'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->textArea($model, 'body', array('placeholder' => Yii::t('web/full_home', 'body'), 'class' => 'form-control', 'rows' => 6, 'cols' => 47)); ?>
                    <?php echo $form->error($model, 'body'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'verifyCode', array('style' => 'color:#FFF')); ?>
                    <div>
                        <?php $this->widget('CCaptcha', array(
                                'captchaAction'  => 'site/captcha?YII_CSRF_TOKEN=' . Yii::app()->request->csrfToken,
                                'buttonLabel'    => '',
                                'clickableImage' => TRUE, 'imageOptions' => array('id' => 'captchaimg'
                                )
                            )
                        );
                        ?>
                        <?php echo $form->textField($model, 'verifyCode', array('class' => 'span3 form-control verifyCode')); ?>

                        <div class="input-group">
                            <?php echo $form->error($model, 'verifyCode'); ?>
                        </div>
                    </div>
                </div>
                <br>

                <div class="form-group submit">
                    <?php echo CHtml::submitButton(Yii::t('web/full_home', 'send'), array('class' => 'btn btn-default')); ?>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <div class="space_30"></div>
        <div class="img_contact">
            <img src="<?= Yii::app()->theme->baseUrl ?>/images/contact.png" alt="">
        </div>
    </div>
    <div class="google_map">
        <div class="mapouter">
            <div class="gmap_canvas">
                <iframe width="100%" height="500" id="gmap_canvas"
                        src="https://maps.google.com/maps?q=Số 16, ngõ 187, Phố Mai Dịch, Phường Mai Dịch, Q. Cầu Giấy, TP. Hà Nội, &t=&z=14&ie=UTF8&iwloc=&output=embed"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                <script src="http://www.embedgooglemap.net/mapscript.js"></script>
                <br>embed google map by <a href="http://www.embedgooglemap.net">embedgooglemap.net</a></div>
            <style>.mapouter {
                    overflow: hidden;
                    height: 500px;
                    width: 100%;
                }

                .gmap_canvas {
                    background: none !important;
                    height: 500px;
                    width: 100%;
                }
                @media only screen and (max-width: 480px) {
                    .mapouter {
                        height: 350px;
                    }

                    .gmap_canvas {
                        height: 350px;
                    }
                }
            </style>
        </div>
        <div class="space_30"></div>
    </div>
</div>