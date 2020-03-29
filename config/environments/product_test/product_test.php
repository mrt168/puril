<?php
/**
 * 本番テスト環境用　設定ファイル
 */

return [
    'EmailTransport' => [
        'default' => [
            'className' => 'Mail',
            // The following keys are used in SMTP transports
            'host' => 'localhost',
            'port' => 25,
            'timeout' => 30,
            'username' => null,
            'password' => null,
            'client' => null,
            'tls' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],

    	'admin' => [
    		'className' => 'Smtp',
    		// The following keys are used in SMTP transports
    		'host' => 'mail.act2008.jp',
    		'port' => 25,
    		'timeout' => 30,
    		'username' => 'yagi@act2008.jp',
    		'password' => 'Si6nPf7WN',
    		'client' => null,
    		'tls' => null,
    		'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
    	]
    ],

	'Email' => [
        'default' => [
            'transport' => 'default',
            'from' => 'you@localhost',
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
        ],

    	'admin' => [
    		'transport' => 'admin',
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
    			'host' => 'localhost',
//     			'port' => 'non_standard_port_number',
    			'username' => 'root',
    			'password' => 'root',
    			'database' => 'salon',
    			'encoding' => 'utf8',
//     			'timezone' => 'UTC',
    			'timezone' => 'Asia/Tokyo',
    			'flags' => [],
    			'cacheMetadata' => true,
    			'log' => true,
    			'quoteIdentifiers' => false,
//     			'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
    			'url' => env('DATABASE_URL', null),
    	],
    ]
];
