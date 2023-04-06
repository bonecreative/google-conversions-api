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
		$clientId      = hash('sha256', $email);
		$transactionId = time();                                            // Replace with a unique transaction ID for each purchase
		$currency      = config(ServiceProvider::SHORT_NAME . '.currency'); // Replace with your currency code
		
		$data = [
			'v'   => '1', // Protocol version
			'tid' => config(ServiceProvider::SHORT_NAME . '.tracking_id'), // Tracking ID (replace with your Google Analytics tracking ID)
			'cid' => $clientId, // Client ID (a unique identifier for each user or session)
			't'   => 'transaction', // Hit type (always set to 'transaction')
			'ti'  => $transactionId, // Transaction ID (a unique ID for each transaction)
			'tr'  => $amount, // Transaction revenue (the total amount of the transaction)
			'cu'  => $currency, // Currency code (the currency used for the transaction)
		];
		
		return self::send($data);
	}
	
	/**
	 * @param $email
	 * @return bool
	 * @see \Bonecreative\GoogleConversionsApi\Test\ClientTest::test_initiateCheckout
	 */
	public static function initiateCheckout($email)
	{
		$clientId = hash('sha256', $email);
		
		$data = [
			'v'   => '1', // Protocol version
			'tid' => config(ServiceProvider::SHORT_NAME . '.tracking_id'), // Tracking ID (replace with your Google Analytics tracking ID)
			'cid' => $clientId, // Client ID (a unique identifier for each user or session)
			't'   => 'event', // Hit type (always set to 'event')
			'ec'  => 'checkout', // Event category (the category of the event)
			'ea'  => 'initiate_checkout', // Event action (the action performed in the event)
		];
		
		return self::send($data);
	}
	
	private static function send($data)
	{
		$client = new Guzzle([
			                     'base_uri' => 'https://www.google-analytics.com',
		                     ]);
		
		$headers = [
			"Authorization" => "Bearer " . config(ServiceProvider::SHORT_NAME . '.api_key'),
			"Content-Type"  => "application/x-www-form-urlencoded",
		];
		
		$response = $client->request('POST', '/collect', [
			'headers'     => $headers,
			'form_params' => $data,
		]);
		
		return ($response->getStatusCode() == 200);
	}
}
