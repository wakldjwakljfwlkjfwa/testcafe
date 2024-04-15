<?php

namespace App;

use App\Handlers\Index;
use App\Handlers\Users\AddUser;
use App\Handlers\Users\GetUsers;
use App\Handlers\Users\Reset;

class Application
{
	public function run(): void
	{
		Dotenv::load();
		$url = $_SERVER['REQUEST_URI'];
		$path = parse_url($url, PHP_URL_PATH);

		$router = $this->setupRoutes();
		$response = $router->route($path);
		echo $response->render();
	}

	private function setupRoutes(): Router
	{
		$router = new Router();

		$router->get('/', new Index());
		$router->get('/users', new GetUsers());
		$router->post('/users', new AddUser());
		$router->delete('/users', new Reset());

		return $router;
	}
}
