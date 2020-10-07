<?php

return [
    'name' => 'Core',
    'app_version' => '1.0.0',
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
                    'text' => 'Faq',
                    'uri' => 'faq.index',
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
