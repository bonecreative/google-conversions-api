<?php

namespace BoneCreative\GoogleConversionsApi;

class Controller extends \App\Http\Controllers\Controller
{

	public function __invoke(Request $request)
	{
		Job::dispatch($request->email, $request->get('amount'));

		return response('success', 200);
	}

}
