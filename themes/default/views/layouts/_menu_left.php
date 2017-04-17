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
                    <a href="" title=""
                       class="parent <?= ($controller == 'site' && $action == 'about') ? 'active' : ''; ?>"><?= Yii::t('web/full_home', 'about'); ?></a>
                </li>
                <li class="">
                    <a href="<?= Yii::app()->controller->createUrl('products/index'); ?>" title=""
                       class="parent <?= ($controller == 'products' && ($action == 'index' || $action == 'detail')) ? 'active' : ''; ?>"><?= Yii::t('web/full_home', 'product'); ?></a>
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
<div class="menu_left">
    <div class="first"><?= Yii::t('web/full_home', 'product'); ?></div>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="level-2 pad_15_0">
                    <a data-toggle="collapse" data-parent="#accordion" href="#menu_1">
                        <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_2_1.png" alt=""
                             class="icon">
                        <span>Gia dụng</span>
                        <img src="<?= Yii::app()->theme->baseUrl ?>/images/arrow.png" alt=""
                             class="arrow">
                    </a>
                </div>
                <div id="menu_1" class="panel-collapse collapse">
                    <ul class='panel-body'>
                        <li class="level-3">
                            <a href="" title="">Bình nước
                                <img src="<?= Yii::app()->theme->baseUrl ?>/images/arrow.png" alt=""
                                     class="arrow">
                            </a>
                            <ul class="has-sub">
                                <li>
                                    <a href="" class="font_13" title="">Bình
                                        nước nhựa</a>
                                </li>
                                <li>
                                    <a href="" class="font_13" title="">Bình
                                        nước thủy tinh</a>
                                </li>
                            </ul>
                        </li>
                        <li class="level-3">
                            <a href="" title="">Hộp đựng thực phẩm <img
                                    src="<?= Yii::app()->theme->baseUrl ?>/images/arrow.png" alt=""
                                    class="arrow">
                            </a>
                            <ul class="has-sub">
                                <li>
                                    <a href="" class="font_13" title="">Hộp nhựa</a>
                                </li>
                                <li>
                                    <a href="" class="font_13" title="">Hộp thủy
                                        tinh</a>
                                </li>
                            </ul>
                        </li>
                        <li class="level-3">
                            <a href="" title="">Thớt</a>
                        </li>
                        <li class="level-3">
                            <a href="" title="">Găng Tay</a>
                        </li>
                        <li class="level-3">
                            <a href="" title="">Dụng cụ vệ sinh</a>
                        </li>
                        <li class="level-3">
                            <a href="" title="">Đồ dùng nhà tắm</a>
                        </li>
                        <li class="level-3">
                            <a href="" title="">Túi giặt</a>
                        </li>
                        <li class="level-3">
                            <a href="" title="">Khác</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="level-2">
                    <a data-toggle="collapse" data-parent="#accordion" href="#menu_2">
                        <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_2_2.png" alt=""
                             class="icon">
                        <span>Hóa phẩm</span>
                        <img src="<?= Yii::app()->theme->baseUrl ?>/images/arrow.png" alt=""
                             class="arrow">
                    </a>
                </div>
                <div id="menu_2" class="panel-collapse collapse">
                    <ul class='panel-body'>
                        <li class="level-3">
                            <a href="" class="font_13" title="">Mỹ phẩm dưỡng da</a>
                        </li>
                        <li class="level-3">
                            <a href="" class="font_13" title="">Chăm sóc tóc</a>
                        </li>
                        <li class="level-3">
                            <a href="" class="font_13" title="">Mỹ phẩm trang điểm</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="level-2">
                    <a data-toggle="collapse" data-parent="#accordion" href="#menu_3">
                        <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_2_3.png" alt=""
                             class="icon">
                        <span>May mặc</span>
                        <img src="<?= Yii::app()->theme->baseUrl ?>/images/arrow.png" alt=""
                             class="arrow">
                    </a>
                </div>
                <div id="menu_3" class="panel-collapse collapse">
                    <ul class='panel-body'>
                        <li class="level-3">
                            <a href="" class="font_13" title="">Tất nam</a>
                        </li class="level-3">
                        <li class="level-3">
                            <a href="" class="font_13" title="">Tất nữ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="level-2">
                    <a data-toggle="collapse" data-parent="#accordion" href="#menu_4">
                        <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_2_4.png" alt=""
                             class="icon">
                        <span>Quà tặng</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>