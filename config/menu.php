<?php

return [
    'sidebar' => [
        /** SAMPLE AVAILABLE PARAMETER
        [
            'type' => 'tree', // 'group' / 'tree' / 'heading' / 'single'
            'label' => 'Menu Title',
            'icon' => 'fa fa-home',
            'url' => '/',
            'active' => '\View::shared("menu_active") == "user"', // cukup taruh di child nya aja, parent otomatis
            'children' => [],
            'required_configs' => [1,2], // kalau parent tidak ada ketentuan khusus cukup taruh di child nya aja
            'required_configs_rule' => 'or',
            'required_features' => [1,2], // kalau parent tidak ada ketentuan khusus cukup taruh di child nya aja
            'required_features_rule' => 'or',
        ],
         */
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
        
    ],
];
