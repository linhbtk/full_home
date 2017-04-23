<?php
    $controller = Yii::app()->controller->id;
    $action     = strtolower(Yii::app()->controller->action->id);
?>
<div class="space_20"></div>
<div id="main_menu">
    <div class="top-menu no-mar">
        <div id="top_nav" class="container">
            <ul class="col-lg-12 col-md-12 level-1 no-pad">
                <li>
                    <a href="<?= Yii::app()->controller->createUrl('site/index'); ?>" title=""
                       class="parent <?= ($controller == 'site' && $action == 'index') ? 'active' : ''; ?>"><?= Yii::t('web/full_home', 'homepage'); ?></a>
                </li>
                <li>
                    <a href="#" title=""
                       class="parent <?= ($controller == 'site' && $action == 'about') ? 'active' : ''; ?>"><?= Yii::t('web/full_home', 'about'); ?></a>
                </li>
                <li class="">
                    <a href="#" title=""
                       class="parent <?= ($controller == 'products' && ($action == 'index' || $action == 'detail')) ? 'active' : ''; ?>"><?= Yii::t('web/full_home', 'product'); ?></a>
                    <ul>
                        <li class="sub_menu">
                            <?php
                                $sub_menu_2 = WCategories::getParentCategories();
                                if ($sub_menu_2):
                                    $index = 1;
                                    foreach ($sub_menu_2 as $level_2):
                                        ?>
                                        <div class='col-md-3'>
                                            <div class="item">
                                                <a href="" class="level-2">
                                                    <img
                                                        src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_<?= $index; ?>.png"
                                                        alt=""
                                                        class="icon">
                                                    <?= CHtml::encode($level_2->name); ?>
                                                </a>
                                                <ul class='dropdown-inner-list'>
                                                    <?php
                                                        $sub_menu_3 = WCategories::getCategoriesByParentId($level_2->id);
                                                        if ($sub_menu_3):
                                                            foreach ($sub_menu_3 as $level_3):
                                                                $sub_menu_4 = WCategories::getCategoriesByParentId($level_3->id);
                                                                ?>
                                                                <li>
                                                                    <a href="<?= Yii::app()->controller->createUrl('products/index', array('id' => $level_3->id)); ?>" class="font_14 white" title="">
                                                                        <?= CHtml::encode($level_3->name); ?>
                                                                        <?php if ($sub_menu_4): ?>
                                                                            <img
                                                                                src="<?= Yii::app()->theme->baseUrl ?>/images/arrow.png"
                                                                                alt=""
                                                                                class="arrow">
                                                                        <?php endif; ?>
                                                                    </a>
                                                                </li>
                                                                <?php
                                                                if ($sub_menu_4):
                                                                    foreach ($sub_menu_4 as $level_4):
                                                                        ?>
                                                                        <li>
                                                                            <a href="<?= Yii::app()->controller->createUrl('products/index', array('id' => $level_4->id)); ?>" class="font_13 gray" title="">
                                                                                <span class="red mar_left_10">+</span>
                                                                                <?= CHtml::encode($level_4->name); ?>
                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php
                                        $index++;
                                    endforeach; ?>
                                <?php endif; ?>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="" title=""
                       class="parent <?= ($controller == 'site' && $action == 'distribution') ? 'active' : ''; ?>"><?= Yii::t('web/full_home', 'distribution'); ?></a>
                </li>
                <li>
                    <a href="" title=""
                       class="parent <?= ($controller == 'site' && $action == 'contact') ? 'active' : ''; ?>"><?= Yii::t('web/full_home', 'contact'); ?></a>
                </li>
            </ul>
        </div>
    </div>
</div>