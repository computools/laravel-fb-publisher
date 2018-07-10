<?php

namespace App\Http\Responses\Post;

use App\Http\Responses\Publication\PublicationTransformer;
use App\Models\Post;
use League\Fractal\TransformerAbstract;
use App\Http\Responses\Theme\ThemeTransformer;

class PostTransformer extends TransformerAbstract
{
	public function transform(Post $post): array
	{
		return [
			'id' => $post->id,
			'title' => $post->title,
			'themes' => (new ThemeTransformer())->transformCollection($post->themes),
			'publications' => (new PublicationTransformer())->transformCollection($post->publications),
			'created_at' => $post->created_at->format(\DateTime::ISO8601),
			'updated_at' => $post->updated_at->format(\DateTime::ISO8601)
		];
	}
}