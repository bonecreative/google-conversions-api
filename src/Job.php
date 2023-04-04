<?php

namespace BoneCreative\GoogleConversionsApi;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class Job implements ShouldQueue
{
	use Dispatchable;
	use InteractsWithQueue;
	use Queueable;
	
	/**
	 * @var null
	 */
	private $amount;
	private $email;
	private $name;
	private $type;
	
	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($email, $amount = null)
	{
		//
		$this->type = (empty($amount))
			? 'InitiateCheckout'
			: 'Purchase';
		
		$this->email  = $email;
		$this->amount = $amount;
	}
	
	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		//
		switch($this->type){
			case 'InitiateCheckout':
				return Client::initiateCheckout($this->email);
			break;
			
			case 'Purchase':
				return Client::purchase($this->email, $this->amount);
			break;
		}
	}
}
