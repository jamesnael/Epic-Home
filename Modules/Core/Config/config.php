<?php

return [
    'name' => 'Core',
    'app_version' => '1.0.0',
    'app_timezone' => 'Asia/Jakarta',
    'main_menu' => [
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
            'icon' => 'mdi-newspaper-variant',
            'icon-alt' => 'mdi-chevron-down',
            'text' => 'Berita Properti',
            'uri' => 'berita-properti.index',
            'model' => false,
            'show' => true,
            'children' => null
        ],
    ]
];
