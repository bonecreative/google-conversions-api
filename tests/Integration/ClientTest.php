<?php

namespace Bonecreative\GoogleConversionsApi\Test;

use BoneCreative\GoogleConversionsApi\Client;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \Bonecreative\GoogleConversionsApi\Client
 */
class ClientTest extends TestCase 
{
	use WithFaker;
	
	/**/#>>

	/**
	 * @see \Bonecreative\GoogleConversionsApi\Client::initiateCheckout
	 * @test
	 */
	public function test_initiateCheckout()
	{
		$email = $this->faker->email;
		$result = Client::initiateCheckout($email);
		$this->assertTrue($result);
	}

	/**
	 * @see \Bonecreative\GoogleConversionsApi\Client::purchase
	 * @test
	 */
	public function test_purchase()
	{
		$result = Client::purchase('test@test.com', 1.00);
		$this->assertTrue($result);
	}
	
}
