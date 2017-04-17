<?php
	if (isset($_GET['subscribe'])) {
		$response = $api->put('/repos' . $_GET['subscribe'] . '/subscription/', ['subscribe' => true]);
	}
	if (isset($_GET['unsubscribe'])) {
		$response = $api->delete('/repos' . $_GET['unsubscribe'] . '/subscription/', ['subscribe' => false]);
	}

	$alert = [];
	if (isset($reesponse)) {
		if (substr($response->getCode(), 0, 1) == 2) {
			$alert['type'] = 'success';
			$alert['title'] = 'Watch Status Updated';
		} else {
			$alert['type'] = 'danger';
			$alert['title'] = 'Unable to update Watch Status';
		}
	}
?>
