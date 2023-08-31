<?php

require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$config = require 'config.php';


$capsule = new Capsule;
$capsule->addConnection($config['connections']['mysql'], 'temp');
$capsule->setAsGlobal();
$capsule->bootEloquent();

createDatabase($config['database']);


function createDatabase(string $database)
{
    global $capsule, $config;
    $config['connections']['mysql']['database'] = $database;
    $capsule->getConnection('temp')->statement("create DATABASE if not EXISTS $database;");
    $capsule->getConnection('temp')->disconnect();
    $capsule->addConnection($config['connections']['mysql']);
}

