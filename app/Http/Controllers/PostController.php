<?php

namespace App\Http\Controllers;

use App\Exceptions\Post\PostNotFoundException;
use App\Exceptions\Theme\ThemeNotFoundException;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Responses\Post\PostTransformer;
use App\Http\Responses\Post\SinglePostTransformer;
use App\Models\Post;
use Illuminate\Http\Response;

class PostController extends ApiController
{
	public function getList(): Response
	{
		return $this->response(
			$this->collection(
				$this->getUser()->posts()->limit(20)->with('themes', 'publications')->get(),
				new PostTransformer()
			)
		);
	}

	public function getPost(int $postId): Response
	{
		return $this->response(
			$this->item(
				$this->getUser()->getPost($postId),
				new SinglePostTransformer()
			)
		);
	}

	public function create(CreatePostRequest $request): Response
	{
		$post = new Post;
		$post->user()->associate($this->getUser());
		$post->fill($request->only(['title', 'content']));
		$post->save();
		return $this->response(
			$this->item($post, new SinglePostTransformer()),
			Response::HTTP_CREATED
		);
	}

	public function update(int $id, CreatePostRequest $request): Response
	{
		$post = $this->getUser()->getPost($id);
		$post->update($request->only(['title', 'content']));
		return $this->response(
			$this->item($post, new SinglePostTransformer()),
			Response::HTTP_OK
		);
	}

	public function addTheme(int $postId, int $themeId): Response
	{
		$post = $this->getUser()->getPost($postId);
		$theme = $this->getUser()->getTheme($themeId);

		if (!$post->themes()->find($theme->getKey())) {
			$post->themes()->attach($theme->getKey());
		}
		return $this->response(
			$this->item($post, new SinglePostTransformer())
		);
	}

	public function removeTheme(int $postId, int $themeId): Response
	{
		$post = $this->getUser()->getPost($postId);
		$theme = $this->getUser()->getTheme($themeId);

		if ($post->themes()->find($theme->getKey())) {
			$post->themes()->detach($theme->getKey());
		}
		return $this->response(
			$this->item($post, new SinglePostTransformer())
		);
	}

	public function delete(int $id): Response
	{
		if (!$post = $this->getUser()->getPost($id)) {
			throw new PostNotFoundException();
		}
		$post->delete();
		return $this->response([], Response::HTTP_NO_CONTENT);
	}
}