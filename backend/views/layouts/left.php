<aside class=" main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => '主菜单', 'options' => ['class' => 'header']],

                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => '学生管理',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'active' => Yii::$app->controller->module->id == 'student',
                        'visible'=> isset($permissions['student']) ? 1 : 0,
                        'items' => [
                            [
                                'label' => '学生列表','icon' => 'fa fa-dot-circle-o',
                                'visible'=> isset($permissions['student']['student']['index']) ? 1 : 0,
                                'active' => Yii::$app->controller->id == 'student',
                                'url' => ['/student/student/index']
                            ],
                            ['label' => '家长列表', 'icon' => 'fa fa-dot-circle-o',
                                'visible'=> isset($permissions['student']['patriarch']['index']) ? 1 : 0,
                                'active' => Yii::$app->controller->id == 'patriarch',
                                'url' => ['/student/patriarch/index']
                            ],
                        ],
                    ],
                    [
                        'label' => '周报管理',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'active' => Yii::$app->controller->module->id == 'weekly',
                        'visible'=> isset($permissions['weekly']) ? 1 : 0,
                        'items' => [
                            ['label' => '学生周报', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'weekly', 'visible'=> isset($permissions['weekly']['weekly']['index']) ? 1 : 0,'url' => ['/weekly/weekly/index']],
                            ['label' => '周报审核(校长)', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'president-check', 'visible'=> isset($permissions['weekly']['president-check']['index']) ? 1 : 0,'url' => ['/weekly/president-check/index']],
                            ['label' => '周报审核(客服)', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'customer-check', 'visible'=> isset($permissions['weekly']['customer-check']['index']) ? 1 : 0,'url' => ['/weekly/customer-check/index']],
                            ['label' => '周报推送', 'icon' => 'fa fa-dot-circle-o', 'active' => Yii::$app->controller->id == 'weekly-push','visible'=> isset($permissions['weekly']['weekly-push']['index']) ? 1 : 0,'url' => ['/weekly/weekly-push/index']],
                            //['label' => '学生影像', 'icon' => 'fa fa-dot-circle-o', 'active' => Yii::$app->controller->id == 'repository','visible'=> isset($permissions['weekly']['repository']['index']) ? 1 : 0,'url' => ['/weekly/repository/index']],
                            //['label' => '影像推送', 'icon' => 'fa fa-dot-circle-o', 'active' => Yii::$app->controller->id == 'repository-push','visible'=> isset($permissions['weekly']['repository-push']['index']) ? 1 : 0,'url' => ['/weekly/repository-push/index']],

                        ],
                    ],
                    [
                        'label' => '员工管理',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'active' => Yii::$app->controller->module->id == 'staff',
                        'visible'=> isset($permissions['staff']) ? 1 : 0,
                        'items' => [
                            ['label' => '员工列表', 'icon' => 'fa fa-dot-circle-o', 'active' => Yii::$app->controller->id == 'staff','visible'=> isset($permissions['staff']['staff']['index']) ? 1 : 0, 'url' => ['/staff/staff/index']],
                        ],
                    ],
                    ['label' => '服务项目列表', 'icon' => 'fa fa-share', 'active' => Yii::$app->controller->module->id == 'serviceProduct','visible'=> isset($permissions['serviceProduct']['service-product']['index']) ? 1 : 0, 'url' => ['/serviceProduct/service-product/index']],
                    [
                        'label' => '订单管理',
                        'icon' => 'fa fa-share',
                        'visible'=> isset($permissions['orders']) ? 1 : 0,
                        'url' => '#',
                        'active' => Yii::$app->controller->module->id == 'orders',
                        'items' => [
                            ['label' => '托辅订单', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'orders', 'visible'=> isset($permissions['orders']['orders']['index']) ? 1 : 0, 'url' => ['/orders/orders/index',]],
                            ['label' => '其他服务订单', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'orders-atv', 'visible'=> isset($permissions['orders']['orders-atv']['index']) ? 1 : 0, 'url' => ['/orders/orders-atv/index']],
                            ['label' => '已过期订单', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->action->id == 'expired-index', 'visible'=> isset($permissions['orders']['orders']['expired-index']) ? 1 : 0, 'url' => ['/orders/orders/expired-index']],
                        ],
                    ],
                    [
                        'label' => '和家服务管理',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'active' => Yii::$app->controller->module->id == 'service',
                        'visible'=> isset($permissions['service']) ? 1 : 0,
                        'items' => [
                            ['label' => '服务分类', 'icon' => 'fa fa-dot-circle-o', 'active' => Yii::$app->controller->id == 'service-category','visible'=> isset($permissions['service']['service-category']['index']) ? 1 : 0, 'url' => ['/service/service-category/index']],
                            ['label' => '家庭服务', 'icon' => 'fa fa-dot-circle-o', 'active' => Yii::$app->controller->id == 'family','visible'=> isset($permissions['service']['family']['index']) ? 1 : 0, 'url' => ['/service/family/index']],
                            ['label' => '校区管理', 'icon' => 'fa fa-dot-circle-o', 'active' => Yii::$app->controller->id == 'auxiliary','visible'=> isset($permissions['service']['auxiliary']['index']) ? 1 : 0, 'url' => ['/service/auxiliary/index']],
                        ],
                    ],
                    [
                        'label' => '消息服务',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'active' => Yii::$app->controller->module->id == 'msg',
                        'visible'=> isset($permissions['msg']) ? 1 : 0,
                        'items' => [
                            ['label' => '官方消息推送', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'msg-push-logs','visible'=> isset($permissions['msg']['msg-push-logs']['index']) ? 1 : 0, 'url' => ['/msg/msg-push-logs/index']],
                        ],
                    ],
                    [
                        'label' => '用户管理',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'active' => Yii::$app->controller->module->id == 'users',
                        'visible'=> isset($permissions['users']) ? 1 : 0,
                        'items' => [
                            ['label' => '用户列表', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'users','visible'=> isset($permissions['users']['users']['index']) ? 1 : 0, 'url' => ['/users/users/index']],
                            ['label' => '用户组', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'role','visible'=> isset($permissions['role']['role']['index']) ? 1 : 0, 'url' => ['/role/role/index']],
                            ['label' => '留言列表', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'guestbook','visible'=> isset($permissions['users']['guestbook']['index']) ? 1 : 0, 'url' => ['/users/guestbook/index']],
                        ],
                    ],
                    ['label' => '活动资讯', 'icon' => 'fa fa-share', 'active' => Yii::$app->controller->module->id == 'events','visible'=> isset($permissions['events']['events']['index']) ? 1 : 0, 'url' => ['/events/events/index']],

                    ['label' => '轮播图管理', 'active' => Yii::$app->controller->module->id == 'ad','visible'=> isset($permissions['ad']['ad']['index']) ? 1 : 0, 'icon' => 'fa fa-share', 'url' => ['/ad/ad/index']],
                    [
                        'label' => '设置',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'active' => Yii::$app->controller->module->id == 'cfg',
                        'visible'=> isset($permissions['cfg']['web-cfg']['index']) ? 1 : 0,
                        'items' => [
                            ['label' => '网站配置', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/cfg/web-cfg/index']],
                        ],
                    ],

                ],
            ]
        ) ?>

    </section>

</aside>
