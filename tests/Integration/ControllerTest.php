<?php

namespace Bonecreative\GoogleConversionsApi\Test;

use Tests\TestCase;

/**
 * @see \Bonecreative\GoogleConversionsApi\Controller
 */
class ControllerTest extends TestCase 
{
	/**/#>>
	
	/**
	 * A basic test example.
	 *
	 * @test
	 * @dataProvider dataProvider
	 * @return void
	 *
	 * @see \Bonecreative\GoogleConversionsApi\Controller::__invoke
	 */
	public function can_post_to_google_analytics($data, $expects)
	{
		
		$this->post(route('analytics::g'), $data)
		     ->assertStatus($expects);
		
	}
	
	public function dataProvider()
	{
		return [
			[['email'  => 'test@test.com',
			  'amount' => "65.22"]
			 , 200],
			
			[['email' => 'test@test.com']
			 , 200],
			
			[['name'   => 'Billy',
			  'email'  => 'test@test.com',
			  'amount' => "ABC"]
			 , 422],
		];
	}
}
