<?php

namespace Tests\Feature;

use App\Subscriber;
use Tests\TestCase;
use App\Mail\SubscriberJoined;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WaitlistControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp() : void
    {
        parent::setUp();

        Mail::fake();
    }

    /** @test */
    public function waitlist_displays_waitlist_subscription_view()
    {
        $response = $this->get(route('waitlist.index'));

        $response->assertSuccessful();

        $response->assertViewIs('waitlist');
    }

    /** @test */
    public function subscribed_displays_subscription_successful_view()
    {
        $response = $this->get(route('waitlist.index'));

        $response->assertSuccessful();

        $response->assertViewIs('waitlist');
    }

    /** @test */
    public function waitlist_subscription_form_displays_validation_error_when_email_is_empty()
    {
        $response = $this->post(route('waitlist.subscribe'), []);

        Mail::assertNotQueued(SubscriberJoined::class);

        $response->assertStatus(302);

        $response->assertSessionHasErrors('email');
    }

     /** @test */
    public function waitlist_subscription_form_displays_validation_error_when_email_is_not_a_valid_email()
    {
        $response = $this->post(route('waitlist.subscribe'), [
            'email' => 'Joe Smith'
        ]);

        Mail::assertNotQueued(SubscriberJoined::class);

        $response->assertStatus(302);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function waitlist_subscription_form_subscribes_guest_and_redirects_to_subscribed()
    {
        $email = $this->faker->unique()->safeEmail;

        $response = $this->post(route('waitlist.subscribe'), [
            'email' => $email
        ]);

        Mail::assertQueued(SubscriberJoined::class);

        $this->assertDatabaseHas('subscribers', [
            'email' => $email
        ]);

        $response->assertRedirect(route('waitlist.subscribed'));

        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function waitlist_subscription_form_displays_validation_error_when_email_is_not_unique()
    {
        $subscriber = factory(Subscriber::class)->create();

        $response = $this->post(route('waitlist.subscribe'), [
            'email' => $subscriber->email
        ]);

        Mail::assertNotQueued(SubscriberJoined::class);

        $response->assertStatus(302);

        $response->assertSessionHasErrors('email');
    }
}
