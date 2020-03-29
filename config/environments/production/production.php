<?php
/**
 * 本番環境用　設定ファイル
 */

return [
    'EmailTransport' => [
        'default' => [
            'className' => 'Mail',
            // The following keys are used in SMTP transports
            'host' => 'sendidapp.net',
            'port' => 25,
            'timeout' => 30,
            'username' => 'info@sendidapp.net',
            'password' => 'NSYBhNsTo5jGWPVW',
            'client' => null,
            'tls' => true,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],

        'contact' => [
            'className' => 'Smtp',
    		// The following keys are used in SMTP transports
    		'host' => 'ssl://smtp.gmail.com',
    		'port' => 465,
    		'timeout' => 30,
		'transport' => 'Smtp',
    		'username' => 'tsurutsuru.info@gmail.com',//'ki@tsuru-tsuru.co.jp',
    		'password' => 'nL9Tag87',//'turuturuno1_2018',
    		'client' => null,
    		'tls' => null,
    		'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ]
    ],

	'Email' => [
        'default' => [
            'transport' => 'default',
            'from' => 'info@sendidapp.net',
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
        ],

    	'contact' => [
    		'transport' => 'contact',
    		'from' => 'info@sample.com',
    		//'charset' => 'utf-8',
    		//'headerCharset' => 'utf-8',
    	],
    ],

	'Datasources' => [

    	'default' => [
    			'className' => 'Cake\Database\Connection',
    			'driver' => 'Cake\Database\Driver\Mysql',
    			'persistent' => false,
    			'host' => '127.0.0.1',
//     			'port' => 'non_standard_port_number',
    			'username' => 'root',
    			'password' => 'gTXfV7W1b4bzpg:1', // 本番
    			'database' => 'datsumou_love',
    			'encoding' => 'utf8mb4',
//     			'timezone' => 'UTC',
    			'timezone' => 'Asia/Tokyo',
    			'flags' => [],
    			'cacheMetadata' => true,
    			'log' => false,
    			'quoteIdentifiers' => false,
//     			'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
    			'url' => env('DATABASE_URL', null),
    	],
    ]
];
