<?php

namespace App\Http\Controllers;

use App\Exceptions\Auth\InvalidCredentialsException;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Responses\Token\TokenTransformer;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends ApiController
{
	public function register(RegisterRequest $request): Response
	{
		$user = User::create([
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'password' => Hash::make($request->get('password'))
		]);

		return $this->response(
			$this->item(JWTAuth::fromUser($user), new TokenTransformer()),
			Response::HTTP_CREATED
		);
	}

	public function login(LoginRequest $request): Response
	{
		if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
			throw new InvalidCredentialsException();
		}
		return $this->response(
			$this->item($token, new TokenTransformer())
		);
	}
}