<?php

namespace BoneCreative\GoogleConversionsApi;

use FuquIo\LaravelRequest\SanitizedRequest;

class Request extends SanitizedRequest
{

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			//
			'email'  => 'required|email',
			'amount' => 'sometimes|numeric',
		];
	}
}
