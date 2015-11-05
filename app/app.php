<?php

// Session Service Provider
$app->register(new Silex\Provider\SessionServiceProvider());

// Routing Service Provider
$app->register(new Silex\Provider\RoutingServiceProvider());

// Twig Service Provider
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'debug' => true,
    'twig.path' => __DIR__.'/views',
));


