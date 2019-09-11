<?php

namespace Tests\Feature;

use Validator;
use App\Subscriber;
use Tests\TestCase;
use App\Http\Requests\WaitlistRequest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WaitlistRequestTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function request_validation_should_pass_when_email_is_valid()
    {       
		$request = new WaitlistRequest();
    	$validator = Validator::make([
            "email"=>$this->faker->safeEmail
        ], $request->rules());
        
    	$this->assertFalse($validator->fails());
    }
    
     /** @test */
	public function request_validation_should_fail_when_email_is_empty()
	{
        $request = new WaitlistRequest();
        $validator = Validator::make([], $request->rules());
        
		$this->assertTrue($validator->fails());
    }

    /** @test */
	public function request_validation_should_fail_when_email_provided_is_not_unique()
	{
        $subscriber = factory(Subscriber::class)->create();

		$request = new WaitlistRequest();
        $validator = Validator::make([
            "email"=> $subscriber->email
        ], $request->rules());
        
		$this->assertTrue($validator->fails());
    }
    
    /** @test */
    public function request_validation_should_fail_when_email_is_not_valid()
    {       
		$request = new WaitlistRequest();
    	$validator = Validator::make([
            "email"=>"Joe Smith"
            ] , $request->rules());

    	$this->assertTrue($validator->fails());
	}
}
