<?php

namespace App\Handlers\Users;

use App\Exceptions\ValidationException;
use App\Request;
use App\RequestHandler;
use App\Response;
use App\User;
use App\UserService;

class AddUser implements RequestHandler
{
	private UserService $userService;

	public function __construct()
	{
		$this->userService = new UserService();
	}

	public function handle(Request $request): Response
	{
		try {
			$json = $this->validate($request);
		} catch (ValidationException $e) {
			$response = new Response();
			$response->setStatusCode(400);
			$response->setHeader('Content-Type', 'application/json');

			$body = json_encode([
				'message' => $e->getMessage()
			]);
			$response->setResponseBody($body);

			return $response;
		}

		$user = new User(
			name: $json['name'],
			email: $json['email'],
		);
		$this->userService->createUser($user);

		$response = new Response();
		$response->setStatusCode(201);
		$response->setHeader('Content-Type', 'application/json');

		$body = json_encode([]);
		$response->setResponseBody($body);

		return $response;
	}

	/**
	 * @throws ValidationException
	 */
	private function validate(Request $request): array
	{
		$json = $request->json();

		if (!isset($json['name'])) {
			throw new ValidationException('name is required');
		}

		if ($json['name'] === '') {
			throw new ValidationException('name cannot be empty');
		}

		if (!isset($json['email'])) {
			throw new ValidationException('email is required');
		}

		if ($json['email'] === '') {
			throw new ValidationException('email cannot be empty');
		}

		if (!filter_var($json['email'], FILTER_VALIDATE_EMAIL)) {
			throw new ValidationException('email is not valid');
		}

		return $json;
	}
}
