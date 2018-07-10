<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
	protected $fillable = [
		'title',
		'content'
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo('App\Models\User', 'user_id', 'id');
	}

	public function themes(): BelongsToMany
	{
		return $this->belongsToMany('App\Models\Theme', 'posts_themes');
	}

	public function publications(): HasMany
	{
		return $this->hasMany('App\Models\Publication');
	}
}