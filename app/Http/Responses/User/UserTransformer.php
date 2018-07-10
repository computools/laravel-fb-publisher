<?php

namespace App\Http\Responses\User;

use App\Models\User;
use Illuminate\Support\Carbon;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	public function transform(User $user): array
	{
		return [
			'id' => $user->id,
			'email' => $user->email,
			'name' => $user->name,
			'created_at' => $user->created_at ? $user->created_at->format(\DateTime::ISO8601) : null,
			'updated_at' => $user->updated_at ? $user->updated_at->format(\DateTime::ISO8601) : null
		];
	}
}