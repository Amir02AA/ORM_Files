<?php
include_once "vendor/autoload.php";
$migrations = scandir('migrations/');
unset($migrations[0]);
unset($migrations[1]);

foreach ($migrations as $migration) {
    $object =new (include_once "migrations/$migration");
    try {
        $object->up();
    }catch (Exception){

    }
}

