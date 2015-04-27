<?php
class ServerController extends \Phalcon\Mvc\Controller {

	public function registerAction() {

		$user = new User();
		$post = $this->request->getPost();
			
		if ($user->save($post)) {
			echo "An email has been sent to {$post['email']}\n";
		} else {
			echo "Registration failed!\n";
		}

	}

}