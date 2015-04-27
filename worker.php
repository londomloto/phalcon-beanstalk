<?php

$queue = new \Phalcon\Queue\Beanstalk(array(
	'host' => '127.0.0.1'
));

$queue->watch('test');

while(($job = $queue->reserve())) {

	$data = $job->getBody();
	
	$action = $data['action'];
	$params = http_build_query($data['params']);

	$ch  = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1/bean/server/'.$action);
	curl_setopt($ch, CURLOPT_POST, count($params));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	$result = curl_exec($ch);
	curl_close($ch);

	var_dump($result);

	$job->delete();
}
