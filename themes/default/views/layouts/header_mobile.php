<div id="header">
    <div class="space_10"></div>
    <a class="bt_menu_left" href="#menu_left"></a>

    <div class="container">
        <a href="<?= Yii::app()->controller->createUrl('site/index'); ?>" title="">
            <img src="<?= Yii::app()->theme->baseUrl ?>/images/logo.png" class="logo" alt="">
        </a>
    </div>
    <a class="bt_menu_right" href="#menu_right"></a>
</div>
<nav id="menu">
    <ul>
        <li class="mparent">
            <a href="javascript:void(0);">
                <?= Yii::t('web/full_home', 'product_category') ?>
            </a>
        </li>
        <li class="msub">
            <a href="">
                <i class="glyphicon glyphicon-chevron-left"></i>
                Đồ gia dụng
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_1.png" alt="" class="icon">
            </a>
        </li>
        <li class="msub">
            <a href="">
                <i class="glyphicon glyphicon-chevron-left"></i>
                Hóa phẩm
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_2.png" alt="" class="icon">
            </a>
        </li>
        <li class="msub">
            <a href="">
                <i class="glyphicon glyphicon-chevron-left"></i>
                May mặc
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_3.png" alt=""
                     class="icon">
            </a>
        </li>
        <li class="msub">
            <a href="">
                <i class="glyphicon glyphicon-chevron-left"></i>
                Quà tặng
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_4.png" alt="" class="icon">
            </a>
        </li>
    </ul>
</nav>

<nav id="menu_right" style="height: 100%">
    <ul class="mm-listview">
        <li class="mparent">
            Hotline
        </li>
    </ul>
</nav>
<script type="text/javascript">
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
                {
                    position: 'top',
                    content: [
                        //'prev',
                        // 'title',
                        // 'close'
                    ]
                },
            ],
            offCanvas: {
                position: "right"
            }
        });
    });
</script>

<!--Menu left-->
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
                    content: [
                        'prev',
                        'title',
                        // 'close'
                    ]
                },
            ],
            slidingSubmenus: false
        });
    });
</script>