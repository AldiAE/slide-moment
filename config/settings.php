<?php

return [

    'KT_THEME_BOOTSTRAP' => [
        'default' => \App\Core\Bootstrap\BootstrapDefault::class,
        'auth' => \App\Core\Bootstrap\BootstrapAuth::class,
        'system' => \App\Core\Bootstrap\BootstrapSystem::class,
    ],

    'KT_THEME' => 'metronic',

    # Theme layout templates directory

    'KT_THEME_LAYOUT_DIR' => 'layout',


    # Theme Mode
    # Value: light | dark | system

    'KT_THEME_MODE_DEFAULT' => 'light',
    'KT_THEME_MODE_SWITCH_ENABLED' => true,


    # Theme Direction
    # Value: ltr | rtl

    'KT_THEME_DIRECTION' => 'ltr',


    # Keenicons
    # Value: duotone | outline | bold

    'KT_THEME_ICONS' => 'duotone',


    # Theme Assets

    'KT_THEME_ASSETS' => [
        'favicon' => 'assets/metronic-8/media/logos/favicon.ico',
        'fonts' => [
            'https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700',
        ],
        'global' => [
            'css' => [
                'assets/metronic-8/plugins/global/plugins.bundle.css',
                'assets/metronic-8/css/style.bundle.css',
                'assets/metronic-8/css/fontawesome-6.4.2/css/fontawesome.css',
                'assets/metronic-8/css/fontawesome-6.4.2/css/brands.css',
                'assets/metronic-8/css/fontawesome-6.4.2/css/solid.css',
                'assets/metronic-8/plugins/custom/jquery-ui/jquery-ui.min.css',
            ],
            'js' => [
                'assets/metronic-8/plugins/global/plugins.bundle.js',
                'assets/metronic-8/js/scripts.bundle.js',
                'assets/metronic-8/js/widgets.bundle.js',
                'assets/metronic-8/plugins/custom/jquery-ui/jquery-ui.min.js',
            ],
        ],
    ],


    # Theme Vendors

    'KT_THEME_VENDORS' => [
        'datatables' => [
            'css' => [
                'assets/metronic-8/plugins/custom/datatables/datatables.bundle.css',
            ],
            'js' => [
                'assets/metronic-8/plugins/custom/datatables/datatables.bundle.js',
            ],
        ],
        'formrepeater' => [
            'js' => [
                'assets/metronic-8/plugins/custom/formrepeater/formrepeater.bundle.js',
            ],
        ],
        'fullcalendar' => [
            'css' => [
                'assets/metronic-8/plugins/custom/fullcalendar/fullcalendar.bundle.css',
            ],
            'js' => [
                'assets/metronic-8/plugins/custom/fullcalendar/fullcalendar.bundle.js',
            ],
        ],
        'flotcharts' => [
            'js' => [
                'assets/metronic-8/plugins/custom/flotcharts/flotcharts.bundle.js',
            ],
        ],
        'google-jsapi' => [
            'js' => [
                '//www.google.com/jsapi',
            ],
        ],
        'tinymce' => [
            'js' => [
                'assets/metronic-8/plugins/custom/tinymce/tinymce.bundle.js',
            ],
        ],
        'ckeditor-classic' => [
            'js' => [
                'assets/metronic-8/plugins/custom/ckeditor/ckeditor-classic.bundle.js',
            ],
        ],
        'ckeditor-inline' => [
            'js' => [
                'assets/metronic-8/plugins/custom/ckeditor/ckeditor-inline.bundle.js',
            ],
        ],
        'ckeditor-balloon' => [
            'js' => [
                'assets/metronic-8/plugins/custom/ckeditor/ckeditor-balloon.bundle.js',
            ],
        ],
        'ckeditor-balloon-block' => [
            'js' => [
                'assets/metronic-8/plugins/custom/ckeditor/ckeditor-balloon-block.bundle.js',
            ],
        ],
        'ckeditor-document' => [
            'js' => [
                'assets/metronic-8/plugins/custom/ckeditor/ckeditor-document.bundle.js',
            ],
        ],
        'draggable' => [
            'js' => [
                'assets/metronic-8/plugins/custom/draggable/draggable.bundle.js',
            ],
        ],
        'fslightbox' => [
            'js' => [
                'assets/metronic-8/plugins/custom/fslightbox/fslightbox.bundle.js',
            ],
        ],
        'jkanban' => [
            'css' => [
                'assets/metronic-8/plugins/custom/jkanban/jkanban.bundle.css',
            ],
            'js' => [
                'assets/metronic-8/plugins/custom/jkanban/jkanban.bundle.js',
            ],
        ],
        'typedjs' => [
            'js' => [
                'assets/metronic-8/plugins/custom/typedjs/typedjs.bundle.js',
            ],
        ],
        'cookiealert' => [
            'css' => [
                'assets/metronic-8/plugins/custom/cookiealert/cookiealert.bundle.css',
            ],
            'js' => [
                'assets/metronic-8/plugins/custom/cookiealert/cookiealert.bundle.js',
            ],
        ],
        'cropper' => [
            'css' => [
                'assets/metronic-8/plugins/custom/cropper/cropper.bundle.css',
            ],
            'js' => [
                'assets/metronic-8/plugins/custom/cropper/cropper.bundle.js',
            ],
        ],
        'vis-timeline' => [
            'css' => [
                'assets/metronic-8/plugins/custom/vis-timeline/vis-timeline.bundle.css',
            ],
            'js' => [
                'assets/metronic-8/plugins/custom/vis-timeline/vis-timeline.bundle.js',
            ],
        ],
        'jstree' => [
            'css' => [
                'assets/metronic-8/plugins/custom/jstree/jstree.bundle.css',
            ],
            'js' => [
                'assets/metronic-8/plugins/custom/jstree/jstree.bundle.js',
            ],
        ],
        'prismjs' => [
            'css' => [
                'assets/metronic-8/plugins/custom/prismjs/prismjs.bundle.css',
            ],
            'js' => [
                'assets/metronic-8/plugins/custom/prismjs/prismjs.bundle.js',
            ],
        ],
        'leaflet' => [
            'css' => [
                'assets/metronic-8/plugins/custom/leaflet/leaflet.bundle.css',
            ],
            'js' => [
                'assets/metronic-8/plugins/custom/leaflet/leaflet.bundle.js',
            ],
        ],
        'amcharts' => [
            'js' => [
                'https://cdn.amcharts.com/lib/5/index.js',
                'https://cdn.amcharts.com/lib/5/xy.js',
                'https://cdn.amcharts.com/lib/5/percent.js',
                'https://cdn.amcharts.com/lib/5/radar.js',
                'https://cdn.amcharts.com/lib/5/themes/Animated.js',
            ],
        ],
        'amcharts-maps' => [
            'js' => [
                'https://cdn.amcharts.com/lib/5/index.js',
                'https://cdn.amcharts.com/lib/5/map.js',
                'https://cdn.amcharts.com/lib/5/geodata/worldLow.js',
                'https://cdn.amcharts.com/lib/5/geodata/continentsLow.js',
                'https://cdn.amcharts.com/lib/5/geodata/usaLow.js',
                'https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js',
                'https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js',
                'https://cdn.amcharts.com/lib/5/themes/Animated.js',
            ],
        ],
        'amcharts-stock' => [
            'js' => [
                'https://cdn.amcharts.com/lib/5/index.js',
                'https://cdn.amcharts.com/lib/5/xy.js',
                'https://cdn.amcharts.com/lib/5/themes/Animated.js',
            ],
        ],
        'bootstrap-select' => [
            'css' => [
                'assets/metronic-8/plugins/custom/bootstrap-select/bootstrap-select.bundle.css',
            ],
            'js' => [
                'assets/metronic-8/plugins/custom/bootstrap-select/bootstrap-select.bundle.js',
            ],
        ],
    ],

];
