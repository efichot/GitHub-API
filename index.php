<?php
require __DIR__ . '/vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

$content = 'This is a playground for working with the GitHub API. We start by searching repositories. We will then setup OAuth, to give authorized users the ability to "Watch" and "Un-watch" repos. From there, each developer will create their own interactions with the API.';

echo $twig->render('home.html', [
    'title' => 'Home',
    'content' => $content
]);