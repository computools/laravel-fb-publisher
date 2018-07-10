<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class DefaultController extends ApiController
{
	public function index(): Response
	{
		return $this->response([
			'message' => 'API for template project'
		]);
	}
}