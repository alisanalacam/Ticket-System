<?php

// Url Generator Service Provider
$app->register(new \Silex\Provider\UrlGeneratorServiceProvider());

// Doctrine Service Provider
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => $app['db.options'],
));

// Session Service Provider
$app->register(new Silex\Provider\SessionServiceProvider(), array(
    'session.storage.save_path' => __DIR__.'/../vendor/sessions',
));

// Doctrine Orm Service Provider
$app->register(new \Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider(), array(
    "orm.proxies_dir" => "/path/to/proxies",
    "orm.em.options" => array(
        "mappings" => array(
            // Using actual filesystem paths
            array(
                "type" => "simple_yml",
                "namespace" => "Ticket\Entity",
                "path" => __DIR__."/../src/Ticket/Resources/config/doctrine",
            ),
        ),
    ),
));


/*'entity' => array(
    'class'     => 'MyProject\Entity\User',
    'property'  => 'username'
)*/

$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.encoders' => array(
        'Ticket\Entity\User' => 'sha512'
    ),
    'security.firewalls' => array(
        'admin' => array(
            'pattern' => '^/',
            'form'    => array(
                'provider' => 'admin',
                'login_path' => 'login',
                'check_path' => 'login_check'
            ),
            'anonymous' => true,
            'users' => $app->share(function() use ($app) {
                //$em = $app['orm.em'];
                //return $em->getRepository('Ticket\Entity\User');
                return new Ticket\Provider\UserProvider($app['db']);
            })
        )
    ),
    'security.user_provider' => array(
        'admin' => new Ticket\Provider\UserProvider($app['db'])
    ),
    'security.authentication_providers' => array(
        /*'user_db' => $app->share(function () use ($app) {
            return new Ticket\Provider\UserProvider($app['db']);
        })*/
        //'admin' => //$app->share(function () use ($app) {
            //return new Ticket\Repository\UserRepository($app['orm.em'], $app['orm.em']->getClassMetadata('Ticket\Entity\User'));
            'admin' => new Ticket\Provider\UserProvider($app['db'])
        //})
        /*'main' => array(
            'entity' => array(
                'class'     => 'Ticket\Entity\User',
                'property'  => 'username'
            )
        )*/
    )
));

$app->boot();

// Twig Service Provider
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'debug' => true,
    'twig.path' => __DIR__.'/views',
));

// Security Service Provider
/*$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.encoders' => array(
        'Ticket\Entity\User' => 'sha512'
    ),
    'security.firewalls' => array(
        'admin' => array(
            'pattern' => '^/admin/',
            'form'    => array(
                'login_path' => '/login',
                'check_path' => '/admin/login_check'
            ),
            'users' => $app->share(function() use ($app) {
                $em = $app['db.orm.em'];
                return $em->getRepository('Ticket\Entity\User');
            })
        )
    ),
    'security.authentication_providers' => array(
        'user_db' => $app->share(function () use ($app) {
            return new Ticket\Provider\UserProvider($app['db']);
        })
    )
));*/

$app['twig'] = $app->extend('twig', function ($twig, $app) {
    $twig->addFunction(new \Twig_SimpleFunction('getCookie', function($cookie) {
        $request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        return $request->cookies->get($cookie);
    }));
    return $twig;
});

// Twig asset function
$app['twig'] = $app->extend('twig', function($twig, $app) {
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) {
        // implement whatever logic you need to determine the asset path

        return sprintf('%s', ltrim($asset, '/'));
    }));

    return $twig;
});

// Twig is_granted function
$function = new Twig_SimpleFunction('is_granted', function($role) use ($app){
    return $app['security']->isGranted($role);
});
$app['twig']->addFunction($function);
