<?php

namespace App\Http\Responses\Theme;

use App\Http\Responses\AbstractTransformer;
use App\Models\Theme;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class ThemeTransformer extends AbstractTransformer
{
	public function transform(Theme $theme): array
	{
		return [
			'id' => $theme->id,
			'title' => $theme->title,
			'created_at' => $theme->created_at->format(\DateTime::ISO8601),
			'updated_at' => $theme->updated_at->format(\DateTime::ISO8601)
		];
	}
}