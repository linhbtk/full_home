<div id="header">
    <div class="container">
        <div class="space_10"></div>
        <a class="bt_menu_left" href="#menu_left">
            <img src="<?= Yii::app()->theme->baseUrl ?>/images/bt_left.png" alt="">
        </a>

        <a href="<?= Yii::app()->controller->createUrl('site/index'); ?>" title="">
            <img src="<?= Yii::app()->theme->baseUrl ?>/images/logo.png" class="logo" alt="">
        </a>
        <a class="bt_menu_right" href="#menu_right">
            <img src="<?= Yii::app()->theme->baseUrl ?>/images/bt_right.png" alt="">
        </a>
    </div>
</div>
<nav id="menu_left">
    <ul>
        <li class="">
            <a href="javascript:void(0);">
                <span class="title_menu"><?= Yii::t('web/full_home', 'product_category') ?></span>
            </a>
        </li>
        <?php
            $sub_menu_2 = WCategories::getParentCategories();
            if ($sub_menu_2):
                $index = 1;
                foreach ($sub_menu_2 as $level_2):
                    ?>
                    <li class="">
            <span class="level-1">
                <div class="space_5"></div>
                <span><?= CHtml::encode($level_2->name); ?></span>
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_<?= $index; ?>.png" alt="" class="icon">
                <div class="space_5"></div>
            </span>
                        <ul>
                            <?php
                                $sub_menu_3 = WCategories::getCategoriesByParentId($level_2->id);
                                if ($sub_menu_3):
                                    foreach ($sub_menu_3 as $level_3):
                                        $sub_menu_4 = WCategories::getCategoriesByParentId($level_3->id);
                                        ?>
                                        <li>
                                            <span class="level-2"><?= CHtml::encode($level_3->name); ?></span>
                                            <ul>
                                                <?php
                                                    if ($sub_menu_4):
                                                        foreach ($sub_menu_4 as $level_4):
                                                            ?>
                                                            <li>
                                                                <a href="<?= Yii::app()->controller->createUrl('products/index', array('id' => $level_4->id)); ?>"
                                                                   title="" class="level-3">
                                                                    <?= CHtml::encode($level_4->name); ?>
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                            </ul>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                        </ul>
                    </li>
                    <?php
                    $index++;
                endforeach; ?>
            <?php endif; ?>
    </ul>
</nav>

<nav id="menu_right">
    <ul>
        <li>
            <span class="txt_hotline"><?= Yii::t('web/full_home', 'txt_hotline'); ?></span>
            <span class="hotline"><?= Yii::t('web/full_home', 'hotline'); ?></span>
        </li>
        <li>
            <a href="" title="" class="level-1"><span><?= Yii::t('web/full_home', 'about'); ?></span></a>
        </li>
        <li>
            <a href="" title="" class="level-1"><span><?= Yii::t('web/full_home', 'distribution'); ?></span></a>
        </li>
        <li>
            <a href="" title="" class="level-1"><span><?= Yii::t('web/full_home', 'contact'); ?></span></a>
        </li>
    </ul>
</nav>

<script type="text/javascript">
    $(function () {
        $('nav#menu_left').mmenu({
            extensions: true,
            searchfield: false,
            counters: false,
            openingInterval: 0,
            transitionDuration: 5,
            navbar: {
                title: ''
            },
            navbars: [
                {
                    position: 'top',
                    content: ['<form class="navbar-form" role="search">' +
                    '<div class="input-group">' +
                    '<input type="text" class="form-control" placeholder="" name="srch-term" id="srch-term" >' +
                    '<div class="input-group-btn" >' +
                    '<button class="btn btn-default" type="submit" > <i class="glyphicon glyphicon-search" > </i></button>' +
                    '</div>' +
                    '</div>' +
                    '</form>'
                    ],
                }
            ],
            slidingSubmenus: true
        });
    });

    $(function () {
        $('nav#menu_right').mmenu({
            extensions: false,
            searchfield: false,
            counters: false,
            openingInterval: 0,
            transitionDuration: 5,
            navbar: {
                title: false
            },
            navbars: [
//                {
//                    position: 'top',
//                    content: [
//                    ]
//                },
            ],
            offCanvas: {
                position: "right"
            }
        });
    });
</script>
