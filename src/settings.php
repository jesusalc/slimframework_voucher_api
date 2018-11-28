<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database connection settings
        "db" => [
            "host" => "127.0.0.1",
            'driver' => 'mysql',
            'database' => 'newsletter2go_voucher_api_test',
            'username' => 'admin',
            'password' => 'toor',
            'collation' => 'utf8_general_ci',
            'charset' => 'utf8',
            'prefix' => ''
        ],


        // Doctrine
//        'doctrine' => [
//            // if true, metadata caching is forcefully disabled
//            'dev_mode' => true,
//
//            // path where the compiled metadata info will be cached
//            // make sure the path exists and it is writable
//            'cache_dir' =>  __DIR__ . '/../logs/',
//
//            // you should add any other path containing annotated entity classes
//            'metadata_dirs' => [ __DIR__ . '/../app/models'],
//
//            'connection' => [
//                'driver' => 'pdo_mysql',
//                'host' => '127.0.0.1',
//                'port' => 3306,
//                'dbname' => 'newsletter2go_voucher_api_test',
//                'user' => 'admin',
//                'password' => 'toor',
//                'charset' => 'utf-8'
//            ]
//        ]


    ],
];
