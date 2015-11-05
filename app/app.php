<?php

// Session Service Provider
$app->register(new Silex\Provider\SessionServiceProvider());

// Twig Service Provider
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));