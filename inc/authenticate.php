<?php
	require_once __DIR__ . '/../vendor/autoload.php';
	session_start();

	$appUrl = 'http://e2r1p12.42.fr:8080';
	$clientId = 'f344afb76b6ad83e7657';
	$clientSecret = '62b9550b9de70ca45971ea45762d7f800fb207a4';

	$config = new Milo\Github\OAuth\Configuration($clientId, $clientSecret, ['user', 'repo']);
	$storage = new Milo\Github\Storages\SessionStorage;
	$login = new Milo\Github\OAuth\Login($config, $storage);
	$api = new Milo\Github\Api;

	if ($login->hasToken()) {
		$token = $login->getToken();
		$api->setToken($token);
	} else {
		if (isset($_GET['redirect'])) {
			$login->obtainToken($_GET['code'], $_GET['state']);
			header('Location: ' . filter_input(INPUT_GET, 'redirect'));
			exit();
		} else {
			$login->askPermissions("$appUrl/inc/autenticate.php?redirect=" . $_SERVER['REQUEST_URI']);
		}
	}
?>
