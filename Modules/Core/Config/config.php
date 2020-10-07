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
    	    ]
    	],
        // [  
        //     'icon' => 'mdi-home-currency-usd',
        //     'icon-alt' => 'mdi-chevron-down',
        //     'text' => 'Tipe Proyek',
        //     'uri' => 'tipe-proyek.index',
        //     'model' => false,
        //     'show' => true,
        //     'children' => null
        // ],
    ]
];
