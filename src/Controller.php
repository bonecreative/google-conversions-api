<?php

namespace BoneCreative\GoogleConversionsApi;

class Controller extends \App\Http\Controllers\Controller
{
	
	
	/**
	 * @param \BoneCreative\GoogleConversionsApi\Request $request
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Symfony\Component\HttpFoundation\Response
	 *
	 * @see \Bonecreative\GoogleConversionsApi\Test\ControllerTest::test___invoke
	 */
	public function __invoke(Request $request)
	{
		Job::dispatch($request->email, $request->get('amount'));

		return response('success', 200);
	}

}
