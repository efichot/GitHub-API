<?php
require __DIR__ . '/vendor/autoload.php';
//require __DIR__ . '/inc/authenticate.php';
require __DIR__ . '/inc/watch.php';

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);
$api = new Milo\Github\Api;

$args = ['title' => 'Search'];
if (!empty($_GET['q'])) {
	$response = $api->get('/search/repositories', ['q' => filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING)]);
	$repository = $api->decode($response);
	$args['items'] = $repository->items;

	$response = $api->get('/user/subscriptions');
	$subscriptions = $api->decode($response);

	foreach ($args['items'] as $k => $item) {
		$subscribed = false;
		foreach ($subscriptions as $sub) {
			if ($item->full_name == $sub->full_name) {
				$subscribed = true;
			}
		}
		$args['items'][$k]->subscribed = $subscribed;
	}
	$args['query'] = '&q=' . filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
}

echo $twig->render('search.html', $args);
