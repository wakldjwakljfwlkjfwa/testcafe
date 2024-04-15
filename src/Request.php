<?php

namespace App;

class Request
{
	public function __construct(
		private string $body = '',
		private array $headers = []
	) {
	}

	public function json(): array
	{
		return json_decode($this->body, true) ?? [];
	}
}
