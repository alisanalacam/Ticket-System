<?php

/*$app['security.role_hierarchy'] = array(
    'ROLE_ADMIN' => array('ROLE_USER', 'ROLE_ALLOWED_TO_SWITCH'),
);

$app['security.access_rules'] = array(
    array('^/admin', 'ROLE_ADMIN'),
    array('^.*$', 'ROLE_USER'),
);



$app['security.firewalls'] = array(
    'unsecured' => array(
        'security' => false
    ),

    'secured' => array(
        'pattern' => '^.*$',
        'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
        'logout' => array('logout_path' => '/logout', 'invalidate_session' => true),
        /*'users' => array(
            // raw password is foo
            'admin' => array('ROLE_ADMIN', '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg=='),
        ),*//*
        'users' => $app->share(function () use ($app) {
            return new Ticket\Provider\UserProvider($app['db']);
        }),
    ),
);

$app['security.authentication_providers'] = array();
$app['security.authentication_providers'] = array(
    'user_db' => $app->share(function () use ($app) {
        return new Ticket\Provider\UserProvider($app['db']);
    })
);
*/
/*'users' => $app->share(function () use ($app) {
    return new MusicBox\Repository\UserRepository($app['db'], $app['security.encoder.digest']);
}),*/