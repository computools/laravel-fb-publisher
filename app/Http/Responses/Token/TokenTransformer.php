<?php

namespace App\Http\Responses\Token;

use League\Fractal\TransformerAbstract;

class TokenTransformer extends TransformerAbstract
{
	public function transform(string $token): array
	{
		return [
			'token' => $token,
			'expires' => (new \DateTime())->add(new \DateInterval('PT' . config('jwt.ttl') . 'M'))->format(\DateTime::ISO8601)
		];
	}
}