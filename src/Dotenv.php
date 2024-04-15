<?php

namespace App;

class Dotenv
{
	public static function load(): void
	{
		$env = file_get_contents(__APP__ . '/.env');

		$lines = explode("\n", $env);

		foreach ($lines as $line) {
			if (strpos(trim($line), '#') === 0 || empty(trim($line))) {
				continue;
			}

			[$key, $value] = explode('=', $line);
			$_ENV[$key] = $value;
		}
	}
}
