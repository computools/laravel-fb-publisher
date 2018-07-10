<?php

namespace App\Services;

use App\Models\Publication;
use Facebook\Authentication\AccessToken;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Facebook;

class FacebookService
{
	/**
	 * @var Facebook
	 */
	private $facebook;
	private $redirectUri;

	public function __construct()
	{
		$this->facebook = resolve('Facebook\Facebook');
		$this->redirectUri = config('facebook.redirect_uri');
	}

	public function getAuthUrl(): string
	{
		return $this->facebook->getRedirectLoginHelper()->getLoginUrl($this->redirectUri, [
			'publish_actions',
			'user_posts'
		]);
	}

	public function getTokenByCode(): AccessToken
	{
		return $this->facebook->getRedirectLoginHelper()->getAccessToken($this->redirectUri);
	}

	public function getClientData(AccessToken $accessToken): array
	{
		$response = $this->facebook->get('/me', $accessToken);
		if ($response->isError()) {
			throw new FacebookResponseException($response);
		}
		return $response->getDecodedBody();
	}

	public function publish(Publication $publication): Publication
	{
		try {
			$response = $this->facebook->post(
				'/me/feed',
				[
					'message' => $publication->post->content
				],
				$publication->channel->access_token
			);
			if ($response->isError()) {
				$publication->success = false;
			} else {
				$publication->success = true;
				$publication->facebook_id = $response->getDecodedBody()['id'];
			}
		} catch (FacebookResponseException $exception) {
			$publication->success = false;
			$publication->error_message = $exception->getMessage();
		} catch (\Exception $exception) {
			$publication->success = false;
		}
		return $publication;
	}
}