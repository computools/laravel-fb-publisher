<?php

namespace App\Http\Controllers;

use App\Exceptions\Theme\ThemeNotFoundException;
use App\Http\Requests\Theme\CreateThemeRequest;
use App\Http\Responses\Theme\ThemeTransformer;
use App\Models\Theme;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ThemeController extends ApiController
{
	public function getList(): Response
	{
		return $this->response(
			$this->collection(
				$this->getUser()->themes,
				new ThemeTransformer()
			)
		);
	}

	public function create(CreateThemeRequest $request): Response
	{
		$theme = new Theme();
		$theme->user()->associate($this->getUser());
		$theme->fill($request->only('title'));
		$theme->save();
		return $this->response(
			$this->item(
				$theme,
				new ThemeTransformer()
			),
			Response::HTTP_CREATED
		);
	}

	public function update(int $themeId, CreateThemeRequest $request): Response
	{
		$theme = $this->getUser()->getTheme($themeId);
		$theme->update($request->only(['title']));
		return $this->response(
			$this->item(
				$theme,
				new ThemeTransformer()
			)
		);
	}

	public function delete(int $themeId): Response
	{
		$theme = $this->getUser()->getTheme($themeId);

		$theme->delete();
		return $this->response([], Response::HTTP_NO_CONTENT);
	}
}