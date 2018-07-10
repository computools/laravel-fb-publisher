<?php

namespace App\Http\Controllers;

use App\Http\Responses\User\UserTransformer;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
	public function getInfo(): Response
	{
		return $this->response($this->item($this->getUser(), new UserTransformer()));
	}
}