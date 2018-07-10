<?php

namespace App\Http\Controllers;

use App\Exceptions\Channel\ChannelAlreadyExistsException;
use App\Http\Responses\Channel\AuthLinkTransformer;
use App\Http\Responses\Channel\ChannelTransformer;
use App\Models\Channel;
use App\Services\FacebookService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChannelController extends ApiController
{
	public function getAuthLink(): Response
	{
		return $this->response($this->item(
			(new FacebookService())->getAuthUrl(),
			new AuthLinkTransformer()
		));
	}

	public function listChannels(): Response
	{
		return $this->response(
			$this->collection(
				$this->getUser()->channels,
				new ChannelTransformer()
			)
		);
	}

	public function delete(int $channelId): Response
	{
		$channel = $this->getUser()->getChannel($channelId);
		$channel->delete();
		return $this->response([], Response::HTTP_NO_CONTENT);
	}

	public function addChannel()
	{
		$facebookService = new FacebookService();
		$accessToken = $facebookService->getTokenByCode();
		$clientData = $facebookService->getClientData($accessToken);
		$channelData = [
			'access_token' => $accessToken->getValue(),
			'expires_at' => $accessToken->getExpiresAt()
		];
		$facebookId = $clientData['id'];
		/**
		 * @var Channel $channel
		 */
		if (!$channel = Channel::where('facebook_id', '=', $facebookId)->get()->first()) {
			$channel = new Channel();
			$channelData['facebook_id'] = $facebookId;
			$channel->user()->associate($this->getUser());
		} else {
			if ($this->getUser()->getKey() !== $channel->user->getKey()) {
				throw new ChannelAlreadyExistsException();
			}
		}
		$channel->fill($channelData);
		$channel->save();
		return $this->response(
			$this->item($channel, new ChannelTransformer()),
			$channel->wasRecentlyCreated ? Response::HTTP_CREATED : Response::HTTP_OK
		);
	}
}