<?php

namespace Bonecreative\GoogleConversionsApi\Test;

use BoneCreative\GoogleConversionsApi\Client;
use BoneCreative\GoogleConversionsApi\ServiceProvider;
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
	
	/**
	 * junk()
	 */
	public function test_junk_login(){
		$measurement_id = env('GA_TRACKING_ID');
		$api_secret     = env('GA_API_SECRET');
		
		$payload = [
			'client_id' => uniqid('phpunit-'),
			'events'    => [
				[
					'name'   => 'login',
					'params' => [
						'method'  => 'email',
						'success' => true
					]
				]
			]
		];
		
		$json_payload = json_encode($payload);
		
		$client = new \GuzzleHttp\Client([
			                                'base_uri' => 'https://www.google-analytics.com',
		                                ]);
		
		$response = $client->post('/mp/collect', [
			'query' => [
				'measurement_id' => $measurement_id,
				'api_secret'     => $api_secret,
			],
			'body'  => $json_payload,
		]);
		
		$this->assertEquals(204, $response->getStatusCode());
	}
	
	/**
	 * junk()
	 *
	 * @test
	 */
	public function test_junk_purchase(){
		$measurement_id = env('GA_TRACKING_ID');
		$api_secret     = env('GA_API_SECRET');
		
		$payload = [
			'client_id' => uniqid('phpunit-'),
			'events' => [
				[
					'name' => 'purchase',
					'params' => [
						'value' => 69.69,
						'currency' => 'USD',
					],
				],
			],
		];
		
		$json_payload = json_encode($payload);
		
		$client = new \GuzzleHttp\Client([
			                                 'base_uri' => 'https://www.google-analytics.com',
		                                 ]);
		
		$response = $client->post('/mp/collect', [
			'query' => [
				'measurement_id' => $measurement_id,
				'api_secret'     => $api_secret,
			],
			'body'  => $json_payload,
		]);
		
		$this->assertEquals(204, $response->getStatusCode());
	}
	
	/**
	 * junk()
	 *
	 * @test
	 */
	public function test_junk_form(){
		$measurement_id = env('GA_TRACKING_ID');
		$api_secret     = env('GA_API_SECRET');
		
		$payload = [
			'client_id' => uniqid('phpunit-'),
			'events'    => [
				[
					'name'   => 'submit_form',
					'params' => [
						'form_name' => 'checkout',
						'success'   => true
					]
				],
			],
		];
		
		$json_payload = json_encode($payload);
		
		$client = new \GuzzleHttp\Client([
			                                 'base_uri' => 'https://www.google-analytics.com',
		                                 ]);
		
		$response = $client->post('/mp/collect', [
			'query' => [
				'measurement_id' => $measurement_id,
				'api_secret'     => $api_secret,
			],
			'body'  => $json_payload,
		]);
		
		$this->assertEquals(204, $response->getStatusCode());
	}
	
	
}
