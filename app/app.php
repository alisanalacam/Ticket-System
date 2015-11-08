<?php
use Silex\Application;
use Silex\Provider;
use Ticket\Provider\UserServiceProvider;

// Url Generator Service Provider Register
$app->register(new \Silex\Provider\UrlGeneratorServiceProvider());

// Doctrine Service Provider Register
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => $app['db.options'],
));

// Session Service Provider Register
$app->register(new Silex\Provider\SessionServiceProvider(), array(
    'session.storage.save_path' => __DIR__.'/../vendor/sessions',
));

// Twig Service Provider Register
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'debug' => true,
    'twig.path' => __DIR__.'/views',
));

// Doctrine Orm Service Provider Register
$app->register(new \Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider(), array(
    "orm.proxies_dir" => "/path/to/proxies",
    "orm.em.options" => array(
        "mappings" => array(
            array(
                "type" => "simple_yml",
                "namespace" => "Ticket\Entity",
                "path" => __DIR__."/../src/Ticket/Resources/config/doctrine",
            ),
        ),
    ),
));

// Security config require
require __DIR__.'/config/security.php';

$app['user.manager'] = $app->share(function($app) {
    $userManager = new Ticket\Provider\UserProvider($app['db']);
    return $userManager;
});


$app['security.authentication_providers'] = array('secured_area' =>
    new Ticket\Provider\AuthProvider($app['user.manager'])
);

// Security Service Provider Register
$app->register(new UserServiceProvider(), array(
    'security.firewalls' => array(
        'secured_area' => array(
            'pattern' => '^.*$',
            'form' => array(
                'login_path' => 'login',
                'check_path' => 'login_check',
            ),
            'anonymous' => true,
            'logout' => array(
                'logout_path' => '/logout',
            ),
            'users' => $app->share(function($app) { return $app['user.manager']; }),
        ),
    ),
    'security.authentication_providers' => $app['security.authentication_providers']
));

$app->boot();

// Twig asset function
$app['twig'] = $app->extend('twig', function($twig) {

    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) {
        return sprintf('/%s', ltrim($asset, '/'));
    }));
    return $twig;
});

// Twig is_granted function
$app['twig'] = $app->extend('twig', function($twig) use ($app) {

    $twig->addFunction(new \Twig_SimpleFunction('is_granted', function($role) use ($app) {
        return $app['security']->isGranted($role);
    }));
    return $twig;
});