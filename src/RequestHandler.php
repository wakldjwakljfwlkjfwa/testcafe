<?php

namespace App;

interface RequestHandler
{
	public function handle(Request $request): Response;
}
