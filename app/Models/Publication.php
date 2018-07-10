<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Publication extends Model
{
	protected $fillable = [];

	public function channel(): BelongsTo
	{
		return $this->belongsTo('App\Models\Channel');
	}

	public function post(): BelongsTo
	{
		return $this->belongsTo('App\Models\Post');
	}
}