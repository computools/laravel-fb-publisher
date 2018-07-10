<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\BaseRequest;

class CreatePostRequest extends BaseRequest
{
	public function rules(): array
	{
		return [
			'title' => 'required|string|max:255',
			'content' => 'required|string'
		];
	}
}