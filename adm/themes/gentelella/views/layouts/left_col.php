<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo $this->createUrl('/aSite/index') ?>" class="site_title"><i
                    class="fa fa-star-half-o"></i>
                <span><?php echo CHtml::encode(Yii::app()->name); ?></span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <?php if (!Yii::app()->user->isGuest) { ?>
            <div class="profile">
                <div class="profile_pic">
                    <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/img.jpg" alt="..."
                         class="img-circle profile_img">
                </div>
                <div class="profile_info">
                    <span>Welcome,</span>

                    <h2><?php echo Yii::app()->user->name ?></h2>
                </div>
            </div>
        <?php } ?>
        <!-- /menu prile quick info -->

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <?php
                    $this->widget('zii.widgets.CMenu',
                        array(
                            'encodeLabel'        => FALSE,
                            'htmlOptions'        => array(
                                'class' => 'nav side-menu',
                            ),
                            'submenuHtmlOptions' => array(
                                'class' => 'nav child_menu',
                                'style' => 'display: none',
                            ),
                            'items'              => array(
                                array(
                                    'label'   => '<i class="fa fa-list"></i> ' . Yii::t('adm/menu', 'menu_categories'),
                                    'url'     => array('/aCategories'),
                                    'visible' => Yii::app()->user->checkAccess('aCategories.*')
                                ),
                                array(
                                    'label'   => '<i class="fa fa-tags"></i> ' . Yii::t('adm/menu', 'menu_products'),
                                    'url'     => array('/aProducts'),
                                    'visible' => Yii::app()->user->checkAccess('aProducts.*'),
                                ),
                                array(
                                    'label'   => '<i class="fa fa-picture-o" aria-hidden="true"></i> ' . Yii::t('adm/menu', 'menu_banners'),
                                    'url'     => array('/aBanners'),
                                    'visible' => Yii::app()->user->checkAccess('aBanners.*'),
                                ),
                                array(
                                    'label'   => '<i class="fa fa-users" aria-hidden="true"></i> ' . Yii::t('adm/menu', 'menu_partners'),
                                    'url'     => array('/aPartners'),
                                    'visible' => Yii::app()->user->checkAccess('aPartners.*'),
                                ),
                            ),
                        )
                    );
                ?>
            </div>

            <div class="menu_section">
                <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'encodeLabel'        => FALSE,
                        'htmlOptions'        => array(
                            'class' => 'nav side-menu',
                        ),
                        'submenuHtmlOptions' => array(
                            'class' => 'nav child_menu',
                            'style' => 'display: none',
                        ),
                        'items'              => array(
                            array(
                                'url'     => 'javascript:;',
                                'label'   => '<i class="fa fa-shield"></i> ' . Rights::t('core', 'Assignments') . ' <span class="fa fa-chevron-down"></span>',
                                'visible' => Yii::app()->user->checkAccess('Admin'),
                                'items'   => array(
                                    array(
                                        'label' => Rights::t('core', 'Assignments'),
                                        'url'   => array('/rights/assignment/view'),
                                    ),
                                    array(
                                        'label' => Rights::t('core', 'Permissions'),
                                        'url'   => array('/rights/authItem/permissions'),
                                    ),
                                    array(
                                        'label' => Rights::t('core', 'Roles'),
                                        'url'   => array('/rights/authItem/roles'),
                                    ),
                                    array(
                                        'label' => Rights::t('core', 'Tasks'),
                                        'url'   => array('/rights/authItem/tasks'),
                                    ),
                                    array(
                                        'label' => Rights::t('core', 'Operations'),
                                        'url'   => array('/rights/authItem/operations'),
                                    ),
                                ),
                            ),
                            array(
                                'url'     => array('/user/admin'),
                                'label'   => '<i class="fa fa-cogs"></i> ' . Yii::app()->getModule('user')->t("Manage User"),
                                'visible' => (Yii::app()->user->checkAccess('User.Admin.Admin') || Yii::app()->user->checkAccess('User.Admin.*')),
                            ),
                            array(
                                'url'     => array('/user'),
                                'label'   => '<i class="fa fa-users"></i> ' . Yii::app()->getModule('user')->t("List User"),
                                'visible' => ((Yii::app()->user->checkAccess('User.Default.Index') || Yii::app()->user->checkAccess('User.Default.*')) && !Yii::app()->user->checkAccess('User.Admin.Admin') && !Yii::app()->user->checkAccess('User.Admin.*')),
                            ),
                            array(
                                'url'     => 'javascript:;',
                                'label'   => '<i class="fa fa-user"></i> ' . Yii::app()->getModule('user')->t("Profile") . ' <span class="fa fa-chevron-down"></span>',
                                'visible' => !Yii::app()->user->isGuest,
                                'items'   => array(
                                    array(
                                        'url'   => Yii::app()->getModule('user')->profileUrl,
                                        'label' => Yii::app()->getModule('user')->t("Profile"),
                                    ),
                                    array(
                                        'url'   => array('/user/profile/edit'),
                                        'label' => Yii::app()->getModule('user')->t("Edit"),
                                    ),
                                    array(
                                        'url'   => array('/user/profile/changepassword'),
                                        'label' => Yii::app()->getModule('user')->t("Change password"),
                                    ),
                                ),
                            ),

                            array(
                                'url'     => 'javascript:;',
                                'label'   => '<i class="fa fa-eraser"></i> Tool <span class="fa fa-chevron-down"></span>',
                                'visible' => !Yii::app()->user->isGuest,
                                'items'   => array(
                                    array(
                                        'url'   => array('/aSendMT/index'),
                                        'label' => 'Gửi MT',
                                    ),
                                ),
                            ),
                            array(
                                'url'     => array('/aClearCache/index'),
                                'label'   => '<i class="fa fa-eraser"></i> ' . Yii::t('app', 'Quản lý Cache'),
                                'visible' => !Yii::app()->user->isGuest && (Yii::app()->user->checkAccess('AClearCache.Index') || Yii::app()->user->checkAccess('AClearCache.*')),
                            ),
                            array(
                                'url'     => Yii::app()->getModule('user')->loginUrl,
                                'label'   => '<i class="fa fa-sign-in"></i> ' . Yii::app()->getModule('user')->t("Login"),
                                'visible' => Yii::app()->user->isGuest,
                            ),
                            array(
                                'url'     => Yii::app()->getModule('user')->logoutUrl,
                                'label'   => '<i class="fa fa-sign-out"></i> ' . Yii::app()->getModule('user')->t("Logout"),
                                'visible' => !Yii::app()->user->isGuest,
                            ),
                        ),
                    ));
                ?>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <?php if (!Yii::app()->user->isGuest) { ?>
            <div class="sidebar-footer hidden-small">
                <a href="<?php echo Yii::app()->request->url ?>" data-toggle="tooltip" data-placement="top"
                   title="<?php echo Yii::t('app', 'Refresh') ?>">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
                <a href="<?php echo $this->createUrl('/rights/authItem/generate') ?>" data-toggle="tooltip"
                   data-placement="top"
                   title="<?php echo Yii::t('app', 'Generate items') ?>">
                    <span class="glyphicon glyphicon-import" aria-hidden="true"></span>
                </a>
                <a href="<?php echo $this->createUrl(Yii::app()->getModule('user')->profileUrl[0]) ?>"
                   data-toggle="tooltip" data-placement="top"
                   title="<?php echo Yii::app()->getModule('user')->t("Profile") ?>">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                </a>
                <a href="<?php echo $this->createUrl(Yii::app()->getModule('user')->logoutUrl[0]) ?>"
                   data-toggle="tooltip" data-placement="top"
                   title="<?php echo Yii::app()->getModule('user')->t("Logout") ?>">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
            </div>
        <?php } ?>
        <!-- /menu footer buttons -->
    </div>
</div>