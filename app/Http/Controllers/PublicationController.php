<?php

namespace App\Http\Controllers;

use App\Http\Responses\Publication\PublicationTransformer;
use App\Models\Publication;
use App\Services\FacebookService;
use Illuminate\Http\Response;

class PublicationController extends ApiController
{
	public function create(int $postId, int $channelId): Response
	{
		$post = $this->getUser()->getPost($postId);
		$channel = $this->getUser()->getChannel($channelId);
		$publication = new Publication();
		$publication->channel()->associate($channel);
		$publication->post()->associate($post);
		$publication = (new FacebookService())->publish($publication);
		$publication->save();
		return $this->response(
			$this->item(
				$publication,
				new PublicationTransformer()
			)
		);
	}
}