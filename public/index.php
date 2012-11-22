<?php
require_once __DIR__.'/bootstrap.php';

use \Respect\Rest\Router;

$app = new Router();
$twig = new Twig_Environment(new Twig_Loader_Filesystem('../views'));

$app->get('/', $twig->render('home.html'));

$app->get('/*', function($slug) {
    return "Redirecting: ".$slug;
});

$app->post('/', function() {
    return "Shortening";
});
