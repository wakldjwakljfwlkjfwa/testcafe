<?php

namespace App;

class Response
{
	private int $statusCode = 200;
	private string $body = '';
	private array $headers = [];

	public function setStatusCode(int $code): void
	{
		$this->statusCode = $code;
	}

	public function setResponseBody(string $body): void
	{
		$this->body = $body;
	}

	public function setHeader(string $key, string $value): void
	{
		$this->headers[$key] = $value;
	}

	public function render(): string
	{
		http_response_code($this->statusCode);

		foreach ($this->headers as $key => $value) {
			header(sprintf('%s: %s', $key, $value));
		}

		return $this->body;
	}
}
