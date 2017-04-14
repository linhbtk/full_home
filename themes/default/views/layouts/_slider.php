<div class="owl-carousel">
    <?php
        if (isset($stacks) && $stacks == 1):?>
            <div class="item">
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/slider_1.jpg" alt="">
            </div>
            <?php
        elseif (isset($stacks) && $stacks == 2):
            ?>
            <div class="item">
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/slider_2.jpg" alt="">
            </div>
            <?php
        else:
            ?>
            <div class="item">
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/slider_3.jpg" alt="">
            </div>
            <?php
        endif;
    ?>
</div><!--end slider-->