<div id="banner">
    <div class="owl-carousel">
        <?php
            $detect  = new MyMobileDetect();
            $banners = WBanners::getListBannersType(WBanners::TYPE_BANNER);
            if ($banners && is_array($banners)):
                foreach ($banners as $item):
                    if ($detect->isMobile()) {
                        $link_img = Yii::app()->params->upload_dir_path . $item->img_mobile;
                    } else {
                        $link_img = Yii::app()->params->upload_dir_path . $item->img_desktop;
                    }
                    if ($item->target_link != ''):
                        ?>
                        <a href="<?= $item->target_link ?>" title="<?= CHtml::encode($item->title); ?>">
                            <div class="item">
                                <img src="<?= $link_img; ?>" alt="<?= CHtml::encode($item->title); ?>">
                            </div>
                        </a>
                    <?php else: ?>
                        <div class="item">
                            <img src="<?= $link_img; ?>" alt="<?= CHtml::encode($item->title); ?>">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
    </div>
</div>