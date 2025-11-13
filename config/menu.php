<?php

use Nette\Utils\Type;

return [
    'sidebar' => [
        /** SAMPLE AVAILABLE PARAMETER
        [
            'type' => 'tree', // 'group' / 'tree' / 'heading' / 'single'
            'label' => 'Menu Title',
            'icon' => 'fa fa-home',
            'url' => '/',
            'active' => '\View::shared("menu_active") == "user"',
            'children' => [],
            'required_configs' => [1,2],
            'required_configs_rule' => 'or',
            'required_features' => [1,2],
            'required_features_rule' => 'or',
        ],
        */

        // 🏠 HOME
        [
            'type'              => 'group',
            'label'             => 'Home',
            'required_features' => [],
            'children'          => [
                [
                    'type'      => 'single',
                    'label'     => 'Home',
                    'icon'      => 'fa-solid fa-house',
                    'url'       => 'home',
                    'active'    => '\View::shared("menu_active") == "home"',
                ],
            ],
        ],

        // 📄 PAGES
        [
            'type'              => 'group',
            'label'             => 'Pages',
            'required_features' => [],
            'children'          => [
                [
                    'type'      => 'single',
                    'label'     => 'Page List',
                    'icon'      => 'fa-solid fa-list',
                    'url'       => 'pages',
                    'active'    => '\View::shared("menu_active") == "pages"',
                ],
                [
                    'type'      => 'single',
                    'label'     => 'Section List',
                    'icon'      => 'fa-solid fa-layer-group',
                    'url'       => 'sections',
                    'active'    => '\View::shared("menu_active") == "sections"',
                ],
                [
                    'type'      => 'single',
                    'label'     => 'Row List',
                    'icon'      => 'fa-solid fa-table-cells',
                    'url'       => 'rows',
                    'active'    => '\View::shared("menu_active") == "rows"',
                ],
            ],
        ],

        [
            'type'              => 'group',
            'label'             => 'Master Data',
            'required_features' => [],
            'children'          => [
                [
                    'type'      => 'single',
                    'label'     => 'Category',
                    'icon'      => 'fa-solid fa-database',
                    'url'       => 'categories',
                    'active'    => '\View::shared("menu_active") == "categories"',
                ],
                [
                    'type'      => 'single',
                    'label'     => 'Events',
                    'icon'      => 'fa-solid fa-upload',
                    'url'       => 'events',
                    'active'    => '\View::shared("menu_active") == "events"',
                ],
            ],
        ],

        // ⚙️ SETTINGS
        [
            'type'              => 'group',
            'label'             => 'Settings',
            'key'               => 'settings',
            'required_features' => [],
            'children'          => [
                [
                    'type'      => 'single',
                    'label'     => 'Header',
                    'icon'      => 'fa-solid fa-bars',
                    'url'       => 'headers',
                    'active'    => '\View::shared("menu_active") == "headers"',
                ],
                [
                    'type'      => 'single',
                    'label'     => 'Footer',
                    'icon'      => 'fa-solid fa-shoe-prints',
                    'url'       => 'footers',
                    'active'    => '\View::shared("menu_active") == "footers"',
                ],
            ],
        ],

    ],
];
