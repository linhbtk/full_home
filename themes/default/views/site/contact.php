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

            <p class="info"><?= Yii::t('web/full_home', 'address_1') ?></p>
            <p class="info"><?= Yii::t('web/full_home', 'address_2') ?></p>

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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.759932982798!2d105.73885921493289!3d21.042289585991025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454f6b0a11265%3A0x2ec5879fa7efbbc!2zQ8O0bmcgdHkgQ-G7lSBwaOG6p24gRnVsbGhvbWU!5e0!3m2!1svi!2s!4v1493949317021" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            <style>
                @media only screen and (max-width: 480px) {
                    .google_map iframe {
                        height: 350px;
                    }
                }
            </style>
        <div class="space_30"></div>
    </div>
</div>