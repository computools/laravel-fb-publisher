<?php

namespace App\Http\Responses\Publication;

use App\Http\Responses\AbstractTransformer;
use App\Http\Responses\Channel\ChannelTransformer;
use App\Models\Publication;

class PublicationTransformer extends AbstractTransformer
{
	public function transform(Publication $publication): array
	{
		return [
			'id' => $publication->id,
			'facebook_id' => $publication->facebook_id,
			'success' => $publication->success,
			'channel' => (new ChannelTransformer())->transform($publication->channel),
			'error_message' => $publication->error_message,
			'published_at' => $publication->published_at ? $publication->published_at->format(\DateTime::ISO8601): null
		];
	}
}