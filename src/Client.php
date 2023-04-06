<?php

namespace BoneCreative\GoogleConversionsApi;

use GuzzleHttp\Client as Guzzle;

abstract class Client
{
	/**
	 * @param $email
	 * @param $amount
	 * @return bool
	 *
	 * @see \Bonecreative\GoogleConversionsApi\Test\ClientTest::test_purchase
	 */
	public static function purchase($email, $amount)
	{
		$payload = [
			'client_id' => hash('sha256', $email),
			'events'    => [
				[
					'name'   => 'purchase',
					'params' => [
						'value'    => $amount,
						'currency' => config(ServiceProvider::SHORT_NAME . '.currency'),
					],
				],
			],
		];
		
		return self::send($payload);
	}
	
	/**
	 * @param $email
	 * @return bool
	 * @see \Bonecreative\GoogleConversionsApi\Test\ClientTest::test_initiateCheckout
	 */
	public static function initiateCheckout($email)
	{
		$payload = [
			'client_id' => hash('sha256', $email),
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
		
		return self::send($payload);
	}
	
	/**
	 * @param array $payload
	 * @return bool
	 */
	public static function send(array $payload): bool
	{
		$measurement_id = env('GA_TRACKING_ID');
		$api_secret     = env('GA_API_SECRET');
		
		$json_payload = json_encode($payload);
		
		$client = new Guzzle([
			                                 'base_uri' => 'https://www.google-analytics.com',
		                                 ]);
		
		$response = $client->post('/mp/collect', [
			'query' => [
				'measurement_id' => $measurement_id,
				'api_secret'     => $api_secret,
			],
			'body'  => $json_payload,
		]);
		
		return ($response->getStatusCode() == 204);
	}
}
