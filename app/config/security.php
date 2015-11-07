<?php

/*$securityConfig = array(
    'security.encoders' => array(
        'Ticket\Entity\User' => 'sha512'
    ),
    'security.firewalls' => array(
        'secured_area' => array(
            'pattern' => '^/',
            'form'    => array(
                'provider' => 'secured_area',
                'login_path' => 'login',
                'check_path' => 'login_check',
                'logout' => 'logout',
                'provider' => 'main',
            ),
            'anonymous' => true,
            'users' => $app->share(function() use ($app) {
                return new Ticket\Provider\UserProvider($app['db']);
            })
        )
    ),
    'security.user_provider' => array(
        //'user_db' => array( 'entity' => array('class' => 'Ticket\Entity\User', 'property' => 'email'))
        'main' => new Ticket\Provider\UserProvider($app['db'])
    ),
    'security.authentication_providers' => array(
        'main' => new Ticket\Provider\UserProvider($app['db'])
    )
);*/
