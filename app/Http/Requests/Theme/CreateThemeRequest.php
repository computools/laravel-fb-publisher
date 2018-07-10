<?php

namespace App\Http\Requests\Theme;

use App\Http\Requests\BaseRequest;

class CreateThemeRequest extends BaseRequest
{
	public function rules(): array
	{
		return [
			'title' => 'required|string|max:255'
		];
	}
}