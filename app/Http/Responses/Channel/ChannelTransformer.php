<?php

namespace App\Http\Responses\Channel;

use App\Http\Responses\AbstractTransformer;
use App\Models\Channel;

class ChannelTransformer extends AbstractTransformer
{
	public function transform(Channel $channel): array
	{
		return [
			'id' => $channel->id,
			'facebook_id' => $channel->facebook_id,
			'expires_at' => $channel->expires_at,
			'created_at' => $channel->created_at->format(\DateTime::ISO8601),
			'updated_at' => $channel->updated_at->format(\DateTime::ISO8601)
		];
	}
}