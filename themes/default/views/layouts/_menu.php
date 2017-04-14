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
                    <a href="<?= Yii::app()->controller->createUrl('site/categories'); ?>" title=""
                       class="parent <?= ($controller == 'site' && ($action == 'categories' || $action == 'productDetail')) ? 'active' : ''; ?>"><?= Yii::t('web/full_home', 'product'); ?></a>
                    <ul>
                        <li class="sub_menu">
                            <div class='col-md-3'>
                                <div class="item">
                                    <a href="" class="level-2">
                                        <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_1.png" alt=""
                                             class="icon">
                                        Gia dụng
                                    </a>
                                    <ul class='dropdown-inner-list'>
                                        <li>
                                            <a href="" class="font_14 white" title="">Bình nước <img
                                                    src="<?= Yii::app()->theme->baseUrl ?>/images/arrow.png" alt=""
                                                    class="arrow"></a>
                                        </li>
                                        <li>
                                            <a href="" class="font_13 gray" title=""><span
                                                    class="red mar_left_10">+</span> Bình nước nhựa</a>
                                        </li>
                                        <li>
                                            <a href="" class="font_13 gray" title=""><span
                                                    class="red mar_left_10">+</span> Bình nước thủy tinh</a>
                                        </li>
                                        <li>
                                            <a href="" class="font_14 white" title="">Hộp đựng thực phẩm <img
                                                    src="<?= Yii::app()->theme->baseUrl ?>/images/arrow.png" alt=""
                                                    class="arrow"></a>
                                        </li>
                                        <li>
                                            <a href="" class="font_13 gray" title=""><span
                                                    class="red mar_left_10">+</span> Hộp nhựa</a>
                                        </li>
                                        <li>
                                            <a href="" class="font_13 gray" title=""><span
                                                    class="red mar_left_10">+</span> Hộp thủy tinh</a>
                                        </li>
                                        <li>
                                            <a href="" class="font_14 white" title="">Thớt</a>
                                        </li>
                                        <li>
                                            <a href="" class="font_14 white" title="">Găng Tay</a>
                                        </li>
                                        <li>
                                            <a href="" class="font_14 white" title="">Dụng cụ vệ sinh</a>
                                        </li>
                                        <li>
                                            <a href="" class="font_14 white" title="">Đồ dùng nhà tắm</a>
                                        </li>
                                        <li>
                                            <a href="" class="font_14 white" title="">Túi giặt</a>
                                        </li>
                                        <li>
                                            <a href="" class="font_14 white" title="">Khác</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class="item border_left_2">
                                    <a href="" class="level-2">
                                        <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_2.png" alt=""
                                             class="icon">
                                        Hóa phẩm
                                    </a>
                                    <ul class='dropdown-inner-list'>
                                        <li>
                                            <a href="" class="font_14 white" title="">Mỹ phẩm dưỡng da</a>
                                        </li>
                                        <li>
                                            <a href="" class="font_14 white" title="">Chăm sóc tóc</a>
                                        </li>
                                        <li>
                                            <a href="" class="font_14 white" title="">Mỹ phẩm trang điểm</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class="item border_left_2">
                                    <a href="" class="level-2">
                                        <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_3.png" alt=""
                                             class="icon">
                                        May mặc
                                    </a>
                                    <ul class='dropdown-inner-list'>
                                        <li>
                                            <a href="" class="font_14 white" title="">Tất nam</a>
                                        </li>
                                        <li>
                                            <a href="" class="font_14 white" title="">Tất nữ</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class="item border_left_2">
                                    <a href="" class="level-2">
                                        <img src="<?= Yii::app()->theme->baseUrl ?>/images/ic_menu_1_4.png" alt=""
                                             class="icon">
                                        Quà tặng
                                    </a>
                                </div>
                            </div>
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