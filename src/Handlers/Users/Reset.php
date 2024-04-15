<?php

namespace App\Handlers\Users;

use App\Request;
use App\RequestHandler;
use App\Response;
use App\UserService;

class Reset implements RequestHandler
{
	public function handle(Request $request): Response
	{
		$userService = new UserService();
		$userService->deleteAllUsers();

		$response = new Response();
		$response->setStatusCode(200);
		$response->setHeader('Content-Type', 'application/json');

		$body = json_encode([]);
		$response->setResponseBody($body);

		return $response;
	}
}
