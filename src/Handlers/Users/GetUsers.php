<?php

namespace App\Handlers\Users;

use App\Request;
use App\RequestHandler;
use App\Response;
use App\UserService;

class GetUsers implements RequestHandler
{
	const TOTAL_SUM = 100;

	public function handle(Request $request): Response
	{
		$users = (new UserService())->getUsers();
		$users = array_map(fn ($user) => $user->toArray(), $users);
		$user_count = count($users);

		if ($user_count !== 0) {
			$toPayValues = $this->distributeEqually(self::TOTAL_SUM, $user_count);

			foreach ($users as $key => $user) {
				$users[$key]['toPay'] = $toPayValues[$key];
			}
		}

		$body = json_encode($users);

		$response = new Response();
		$response->setStatusCode(200);
		$response->setHeader('Content-Type', 'application/json');
		$response->setResponseBody($body);

		return $response;
	}


	/**
	 * Stolen from ChatGPT
	 */
	private function distributeEqually(int $totalSum, int $numberOfPeople): array
	{
		$result = [];

		$baseAmount = floor($totalSum / $numberOfPeople);

		$remainder = $totalSum % $numberOfPeople;

		for ($i = 0; $i < $numberOfPeople; $i++) {
			$result[$i] = $baseAmount;
		}

		for ($i = 0; $i < $remainder; $i++) {
			$result[$i]++;
		}

		return $result;
	}
}
