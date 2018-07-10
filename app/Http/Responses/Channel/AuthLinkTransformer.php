<?php

namespace App\Http\Responses\Channel;

use League\Fractal\TransformerAbstract;

class AuthLinkTransformer extends TransformerAbstract
{
	public function transform(string $link): array
	{
		return [
			'link' => $link
		];
	}
}