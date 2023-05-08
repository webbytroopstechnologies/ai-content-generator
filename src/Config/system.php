<?php
return [
    
    [
        'key'  => 'general',
        'name' => 'admin::app.admin.system.general',
        'sort' => 1,
    ],
    [
        'key'  => 'general.aiContentGenerator',
        'name' => 'ai-content-generator::app.admin.system.ai-content-generator',
        'sort' => 4,
    ], 
    [
        'key'    => 'general.aiContentGenerator.general',
        'name'   => 'ai-content-generator::app.admin.system.general',
        'sort'   => 0,
        'fields' => [
            [
                'name'          => 'ai-content-generator-enable',
                'title'         => 'admin::app.admin.system.enable',
                'type'          => 'boolean',
                'channel_based' => true,
                'locale_based'  => false
            ],
            [
                'name'          => 'ai-content-generator-api-key',
                'title'         => 'ai-content-generator::app.admin.system.api-key',
                'type'          => 'password',
                'validation'    => false,
                'channel_based' => false,
                'locale_based'  => false,
                'info'          => "You can follow <a href='https://platform.openai.com/account/api-keys' target='_blank'>this link</a> to generate the API Key ."
                
            ],
            [
                'name'          => 'ai-content-generator-allowed-fields',
                'title'         => 'ai-content-generator::app.admin.system.allowed-fields',
                'type'          => 'multiselect',
                'validation'    => false,
                'channel_based' => false,
                'locale_based'  => false,
                'options' => [
                    [
                        'value' => "admin.catalog.products-description", 
                        'title' => 'Product Description'
                    ],
                    [
                        'value' => "admin.catalog.products-short_description", 
                        'title' => 'Product Short Description'
                    ],
                    [
                        'value' => "admin.catalog.products-meta_title", 
                        'title' => 'Product Meta Title'
                    ],
                    [
                        'value' => "admin.catalog.products-meta_keywords", 
                        'title' => 'Product Meta Keywords'
                    ],
                    [
                        'value' => "admin.catalog.products-meta_description", 
                        'title' => 'Product Meta Description'
                    ],
                    [
                        'value' => "admin.cms-meta_title", 
                        'title' => 'Page Meta Title'
                    ],
                    [
                        'value' => "admin.cms-meta_keywords", 
                        'title' => 'Page Meta Keywords'
                    ],
                    [
                        'value' => "admin.cms-meta_description", 
                        'title' => 'Page Meta Description'
                    ]
                ]
                
            ]
        ],
    ]
];
