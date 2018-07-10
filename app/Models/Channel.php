<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Channel extends Model
{
	protected $fillable = [
		'facebook_id',
		'access_token',
		'expires_at'
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo('App\Models\User');
	}
}