<?php

namespace App;

class Router
{
	/**
	 * @var array<string, RequestHandler>
	 */
	private array $routes = [];

	public function get(string $path, RequestHandler $handler): void
	{
		$path = rtrim($path, '/');
		$this->routes['GET ' . $path] = $handler;
	}

	public function post(string $path, RequestHandler $handler): void
	{
		$path = rtrim($path, '/');
		$this->routes['POST ' . $path] = $handler;
	}

	public function delete(string $path, RequestHandler $handler): void
	{
		$path = rtrim($path, '/');
		$this->routes['DELETE ' . $path] = $handler;
	}

	public function route(string $path): Response
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$body = file_get_contents('php://input');
		$path = rtrim($path, '/');
		$handler = $this->routes[$method . ' ' . $path] ?? null;

		if (!$handler) {
			$response = new Response();
			$response->setStatusCode(404);
			$response->setResponseBody('Not Found');

			return $response;
		}

		try {
			return $handler->handle(new Request(body: $body));
		} catch (\Exception $e) {
			$response = new Response();
			$response->setStatusCode(500);
			$response->setResponseBody($e->getMessage());

			return $response;
		}
	}
}
