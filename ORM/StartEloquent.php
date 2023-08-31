<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$config = [
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'eloquent',
            'username' => 'root',
            'password' => ''
        ]
    ]
];

$capsule = new Capsule;
$capsule->addConnection($config['connections']['mysql']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
