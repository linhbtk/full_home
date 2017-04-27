<?php
    /* @var $this SiteController */
    /* @var $agency WAgency */
?>
<div class="br_top hidden-xs">
    <div class="container">
        <div class="col-md-12">
            <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'       => array(
                        '<span class="home_link">' . Yii::t('web/full_home', 'list_agency') . '</span>'
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
    <div class="agency">
        <div class="space_40"></div>
        <?php
            if ($agency):
                foreach ($agency as $item):
                    ?>
                    <div class="item">
                        <div class="space_10"></div>
                        <div class="col-md-7 col-xs-12">
                            <div class="txt_title">
                                <?= CHtml::encode($item->title); ?>
                            </div>
                            <div class="txt_des">
                                <?= CHtml::encode($item->address); ?>
                            </div>
                        </div>
                        <div class="col-md-5 col-xs-12">
                            <div class="thumbnail">
                                <img src="<?= Yii::app()->params->upload_dir . $item->folder_path; ?>" alt="">
                            </div>
                        </div>
                        <div class="space_10"></div>
                    </div>
                    <div class="space_30"></div>
                <?php endforeach; ?>
            <?php endif; ?>
    </div>
</div>