<?php
	$fd = curl_init('https://api.github.com/users/efichot');
	curl_setopt($fd, CURLOPT_USERAGENT, 'etienne');
	curl_setopt($fd, CURLOPT_RETURNTRANSFER, 1);
	$return = curl_exec($fd);
	$results = json_decode($return);
	//var_dump($results);
	echo '<img src=' . $results->avatar_url . ' />';
	curl_close($fd);
 ?>
