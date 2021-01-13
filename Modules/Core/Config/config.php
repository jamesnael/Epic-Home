<?php

return [
    'name' => 'Core',
    'app_version' => '1.0.0',
    'app_timezone' => 'Asia/Jakarta',
    'main_menu' => [
        [  
            'icon' => 'mdi-desktop-mac-dashboard',
            'icon-alt' => 'mdi-chevron-down',
            'text' => 'Dashboard',
            'uri' => 'dashboard.index',
            'model' => false,
            'show' => true,
            'children' => null
        ],
    	[
    	    'icon' => 'mdi-database',
    	    'icon-alt' => 'mdi-chevron-down',
    	    'text' => 'Master Data',
    	    'model' => false,
    	    'show' => true,
    	    'children' => [
    	        [
    	            'icon' => 'mdi-adjust',
    	            'text' => 'Tipe Proyek',
    	            'uri' => 'tipe-proyek.index',
    	            'model' => false,
    	            'show' => true
    	        ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Tipe Bangunan',
                    'uri' => 'tipe-bangunan.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Tipe Cluster',
                    'uri' => 'cluster.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Tipe Unit',
                    'uri' => 'tipe-unit.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Agent Property',
                    'uri' => 'agent-property.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Proyek Primary',
                    'uri' => 'proyek-primary.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Developer',
                    'uri' => 'developer.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Bank',
                    'uri' => 'bank.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Secondary Unit',
                    'uri' => 'secondary-unit.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'FAQ',
                    'uri' => 'faq.index',
                    'model' => false,
                    'show' => true
                ],
    	    ]
    	],
        [
            'icon' => 'mdi-account-group',
            'icon-alt' => 'mdi-chevron-down',
            'text' => 'Kelola User',
            'model' => false,
            'show' => true,
            'children' => [
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Grup User',
                    'uri' => 'grup-user.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'User',
                    'uri' => 'user.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Customer',
                    'uri' => 'customer.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Sales',
                    'uri' => 'sales.index',
                    'model' => false,
                    'show' => true
                ],
            ]
        ],
        [
            'icon' => 'mdi-calculator',
            'icon-alt' => 'mdi-chevron-down',
            'text' => 'Transaksi',
            'model' => false,
            'show' => true,
            'children' => [
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Titip Jual/Sewa Unit',
                    'uri' => 'titip-jual-sewa.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Proyek Primary',
                    'uri' => 'transaksi-proyek-primary.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Secondary Unit',
                    'uri' => 'transaksi-secondary-unit.index',
                    'model' => false,
                    'show' => true
                ],
            ]
        ],
        [  
            'icon' => 'mdi-newspaper-variant-outline',
            'icon-alt' => 'mdi-chevron-down',
            'text' => 'Berita Properti',
            'uri' => 'berita-properti.index',
            'model' => false,
            'show' => true,
            'children' => null
        ],
        [  
            'icon' => 'mdi-monitor-multiple',
            'icon-alt' => 'mdi-chevron-down',
            'text' => 'Sales Monitoring',
            'uri' => 'sales-monitoring.index',
            'model' => false,
            'show' => true,
            'children' => null
        ],
    ],
    'user_menu' => [
        [  
            'icon' => 'mdi-power',
            'text' => 'Logout',
            'uri' => 'logout',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        base_path('public') => base_path('admin/public'),
        base_path() . '/../fonts' => base_path('fonts'),
    ],
];
