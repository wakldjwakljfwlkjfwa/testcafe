<?php

namespace App;

class User
{
	public function __construct(
		public string $name,
		public string $email,
	) {
	}

	public function toArray(): array
	{
		return [
			'name' => $this->name,
			'email' => $this->email,
		];
	}
}
