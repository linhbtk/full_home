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
        <li class="">
            <span class="level-1">
                <div class="space_5"></div>
                <span>Đồ gia dụng</span>
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_1.png" alt="" class="icon">
                <div class="space_5"></div>
            </span>
            <ul>
                <li>
                    <span class="level-2">Bình nước</span>
                    <ul>
                        <li>
                            <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title="" class="level-3">Bình nước nhựa</a>
                        </li>
                        <li>
                            <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title="" class="level-3">Bình nước thủy tinh</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <span class="level-2">Hộp đựng thực phẩm</span>
                    <ul>
                        <li>
                            <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title="" class="level-3">Hộp nhựa</a>
                        </li>
                        <li>
                            <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title="" class="level-3">Hộp thủy tinh</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title="" class="level-2">Thớt</a>
                </li>
                <li>
                    <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title="" class="level-2">Găng Tay</a>
                </li>
                <li>
                    <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title="" class="level-2">Dụng cụ vệ sinh</a>
                </li>
                <li>
                    <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title="" class="level-2">Đồ dùng nhà tắm</a>
                </li>
                <li>
                    <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title="" class="level-2">Túi giặt</a>
                </li>
                <li>
                    <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title="" class="level-2">Khác</a>
                </li>
            </ul>
        </li>
        <li class="">
            <span class="level-1">
                <div class="space_10"></div>
                <span>Hóa phẩm</span>
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_2.png" alt="" class="icon">
            </span>
            <ul>
                <li>
                    <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title="" class="level-2">Mỹ phẩm dưỡng da</a>
                </li>
                <li>
                    <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title="" class="level-2">Chăm sóc tóc</a>
                </li>
                <li>
                    <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title="" class="level-2">Mỹ phẩm trang điểm</a>
                </li>
            </ul>
        </li>
        <li class="">
            <span class="level-1">
                <div class="space_10"></div>
                <span>May mặc</span>
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_3.png" alt=""
                     class="icon">
            </span>
            <ul>
                <li>
                    <a href="" title="" class="level-2">Tất nam</a>
                </li>
                <li>
                    <a href="" title="" class="level-2">Tất nữ</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="" class="level-1">
                <div class="space_10"></div>
                <span>Quà tặng</span>
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_4.png" alt="" class="icon">
            </a>
        </li>
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
