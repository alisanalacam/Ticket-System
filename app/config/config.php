<?php

// Timezone.
date_default_timezone_set('Europe/Istanbul');

// Cache
$app['cache.path'] = __DIR__ . '/../cache';

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'ticket',
    'user'     => 'root',
    'password' => '123',
    'charset' => 'utf8'
);

// SwiftMailer
$app['swiftmailer.options'] = array(
    'host' => 'host',
    'port' => '25',
    'username' => 'username',
    'password' => 'password',
    'encryption' => null,
    'auth_mode' => null
);