<?php

namespace App\Handlers;

use App\RequestHandler;
use App\Request;
use App\Response;

class Index implements RequestHandler
{
	public function handle(Request $request): Response
	{
		$response = new Response();

		$page = file_get_contents(__APP__ . '/pages/index.html');
		$response->setResponseBody($page);

		return $response;
	}
}
