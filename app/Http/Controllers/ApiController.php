<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedApiException;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\TransformerAbstract;

abstract class ApiController extends Controller
{
	protected function getUser(): User
	{
		if (!$user = Auth::user()) {
			throw new UnauthorizedApiException('This route requires authorization');
		}
		return $user;
	}

	protected function item($data, TransformerAbstract $transformer): array
	{
		return (new Manager())
			->setSerializer(new DataArraySerializer())
			->createData(new Item($data, $transformer))
			->toArray();
	}

	protected function collection($data, TransformerAbstract $transformer): array
	{
		return (new Manager())
			->setSerializer(new DataArraySerializer())
			->createData(new Collection($data, $transformer))
			->toArray();
	}

	protected function response($data, int $statusCode = Response::HTTP_OK): Response
	{
		return response($data, $statusCode);
	}
}