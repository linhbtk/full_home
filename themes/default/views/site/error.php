<?php
    $this->pageTitle = Yii::app()->name . ' - Error';
?>
<div class="br_top hidden-xs">
    <div class="container">
        <div class="col-md-12">
            <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'       => array(
                        '<span class="home_link">Error</span>',
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
<div class="container" style="min-height: 500px;background-color: #FFF;">
    <h2>Error <?php echo $code; ?></h2>

    <div class="error">
        <?php echo CHtml::encode($message); ?>
    </div>
</div>