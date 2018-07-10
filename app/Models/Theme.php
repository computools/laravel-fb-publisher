<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Theme extends Model
{
	protected $fillable = [
		'title'
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo('App\Models\User');
	}

	public function posts(): BelongsToMany
	{
		return $this->belongsToMany('App\Models\Post');
	}
}