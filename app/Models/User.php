<?php

namespace App\Models;

use App\Exceptions\Channel\ChannelNotFoundException;
use App\Exceptions\Post\PostNotFoundException;
use App\Exceptions\Theme\ThemeNotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(): HasMany
	{
		return $this->hasMany('App\Models\Post');
	}

	public function themes(): HasMany
	{
		return $this->hasMany('App\Models\Theme');
	}

	public function channels(): HasMany
	{
		return $this->hasMany('App\Models\Channel');
	}

	public function getPost(int $id, $throwIfNotFound = true): ?Post
	{
		$post = $this->posts()->with('themes')->with('publications')->find($id);
		if (!$post && $throwIfNotFound) {
			throw new PostNotFoundException();
		}
		return $post;
	}

	public function getTheme(int $themeId, $throwIfNotFound = true): ?Theme
	{
		$theme = $this->themes()->find($themeId);
		if (!$theme && $throwIfNotFound) {
			throw new ThemeNotFoundException();
		}
		return $theme;
	}

	public function getChannel(int $channelId, $throwIfNotFound = true): ?Channel
	{
		$channel = $this->channels()->find($channelId);
		if (!$channel && $throwIfNotFound) {
			throw new ChannelNotFoundException();
		}
		return $channel;
	}

    public function getJWTIdentifier(): int
	{
		return $this->getKey();
	}

	public function getJWTCustomClaims(): array
	{
		return [];
	}
}
