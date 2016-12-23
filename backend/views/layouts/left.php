<aside class="main-sidebar">

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
                        'items' => [
                            ['label' => '学生列表', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/student/student/index']],
                            ['label' => '学生周报', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/student/weekly/index']],
                            ['label' => '家长列表', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/student/patriarch/index']],
                        ],
                    ],
                    [
                        'label' => '员工管理',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => '员工列表', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/staff/staff/index']],
                        ],
                    ],
                    ['label' => '服务项目列表', 'icon' => 'fa fa-share', 'url' => ['/serviceProduct/service-product/index']],
                    ['label' => '影像资料管理', 'icon' => 'fa fa-share', 'url' => ['/repository/repository/index']],
                    ['label' => '订单管理', 'icon' => 'fa fa-share', 'url' => ['/orders/orders/index']],
                    [
                        'label' => '和家服务管理',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => '服务分类', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/service/service-category/index']],
                            ['label' => '家庭服务', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/service/family/index']],
                            ['label' => '托辅服务', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/service/auxiliary/index']],
                        ],
                    ],
                    [
                        'label' => '消息服务',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => '学生周报推送', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/msg/weekly-push-logs/index']],
                            ['label' => '学生影像推送', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/msg/repository-push-logs/index']],
                            ['label' => '官方消息推送', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/msg/msg-push-logs/index']],
                        ],
                    ],
                    [
                        'label' => '用户管理',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => '用户列表', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/users/users/index']],
                            ['label' => '用户组', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/role/role/index']],
                            ['label' => '留言列表', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/users/guestbook/index']],
                        ],
                    ],
                    [
                        'label' => '产品管理',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => '产品列表', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/product/product/index']],
                            ['label' => '产品分类', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/product/product-category/index']],
                        ],
                    ],
                    ['label' => '活动资讯', 'icon' => 'fa fa-share', 'url' => ['/events/events/index']],

                    ['label' => '轮播图管理', 'icon' => 'fa fa-share', 'url' => ['/ad/ad/index']],
                    [
                        'label' => '设置',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => '网站配置', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/cfg/web-cfg/index']],
                        ],
                    ],

                    [
                        'label' => '微信后台',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => '用户生活资料库', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/user-live/index']],
                            ['label' => '文章管理', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/article/index']],
                            ['label' => '产品管理', 'icon' => 'fa fa-dot-circle-o', 'url' => ['/goods/index']],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
