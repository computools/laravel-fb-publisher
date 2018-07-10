<?php

namespace App\Http\Responses;

use League\Fractal\TransformerAbstract;

abstract class AbstractTransformer extends TransformerAbstract
{
	public function transformCollection($collection)
	{
		$result = [];
		foreach($collection as $item) {
			$result[] = $this->transform($item);
		}
		return $result;
	}
}