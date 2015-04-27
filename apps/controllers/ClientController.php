<?php

class ClientController extends \Phalcon\Mvc\Controller {

	public function indexAction() {

		$queue = new \Phalcon\Queue\Beanstalk(array(
			'host' => '127.0.0.1'
		));

		$queue->choose('test');

		$id = $queue->put(
			array(
				'action' => 'register',
				'params' => array(
					'email' => 'admin@example.com'
				)
			),
			array(
				'priority' => 0
			)
		);

		var_dump($id);

	}

}