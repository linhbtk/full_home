<?php $this->beginContent('//layouts/main'); ?>
<?php
    if (isset($this->breadcrumbs)) {
        echo "<div class='breadcrumbs'>";
        $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'       => $this->breadcrumbs,
            'separator'   => CHtml::image(Yii::app()->baseUrl.'/images/ic_breadcrumbs.png', '', array('class' => 'separator')),
            'htmlOptions' => array('class' => 'breadcrumb'),
        ));
        echo "</div>";
    }
?>
<?php $this->widget('booster.widgets.TbAlert'); ?>
<?php $this->renderPartial('//layouts/_menu'); ?>
<?php echo $content; ?>
<?php $this->endContent(); ?>
