<?php
require __DIR__ . '/vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

$packages = array();
$composer = json_decode(file_get_contents('composer.lock'));
foreach ($composer->packages as $package) {
    $repo = substr($package->source->url, 19, -4);
    $packages[] = [
        'full_name' => $repo,
        'version' => $package->version
    ];
}
echo $twig->render('project.html', [
    'title' => 'Project Repos',
    'items' => $packages
]);