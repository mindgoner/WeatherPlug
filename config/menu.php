<?php

return [
    "sensors" => [
        "title" => "Sensors",
        "icon" => '<em class="icon ni ni-capsule"></em>',
        "children" => [
            [
                'type' => 'item',
                'route' => 'sensor_groups.index',
                'title' => 'Sensor Groups',
                'icon' => '<i class="fa-solid fa-calendar"></i>',
                /*'type' => 'group',
                'group' => [
                    [
                        'type' => 'item',
                        'route' => 'home',
                        'title' => 'Group 1',
                        'icon' => '<em class="icon ni ni-dashboard-fill"></em>',
                    ],
                    [
                        'type' => 'item',
                        'route' => 'home',
                        'title' => 'Group 2',
                        'icon' => '<em class="icon ni ni-dashboard-fill"></em>',
                    ],
                    [
                        'type' => 'item',
                        'route' => 'home',
                        'title' => 'Group 3',
                        'icon' => '<em class="icon ni ni-dashboard-fill"></em>',
                    ],
                ]*/
            ],
            [
                'type' => 'item',
                'route' => 'login',
                'title' => 'Sensors',
                'icon' => '<em class="icon ni ni-dashboard-fill"></em>',
            ],
            [
                'type' => 'item',
                'route' => 'login',
                'title' => 'Reports',
                'icon' => '<em class="icon ni ni-dashboard-fill"></em>',
            ],
            [
                'type' => 'header',
                'title' => 'Sensor Data',
            ],
        ]
    ],
    "account" => [
        "title" => "Account",
        "icon" => '<em class="icon ni ni-menu-circled"></em>',
        "children" => [
            [
                'type' => 'header',
                'title' => 'Account Management',
            ],
            [
                'type' => 'item',
                'route' => 'login',
                'title' => 'Users',
                'icon' => '<em class="icon ni ni-dashboard-fill"></em>',
            ],
            [
                'type' => 'item',
                'route' => 'login',
                'title' => 'Groups',
                'icon' => '<em class="icon ni ni-dashboard-fill"></em>',
            ],
        ]
    ],
    "api" => [
        "title" => "API Keys",
        "icon" => '<em class="icon ni ni-dashboard-fill"></em>',
        "children" => [
            [
                'type' => 'header',
                'title' => 'API Key Management',
            ],
            [
                'type' => 'item',
                'route' => 'login',
                'title' => 'API Keys',
                'icon' => '<em class="icon ni ni-dashboard-fill"></em>',
            ],
        ]
    ],
];