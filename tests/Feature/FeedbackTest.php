<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeedbackTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_view_feedback_form()
    {
        $response = $this->get('/');
        $response->assertStatus(200)
                ->assertSee('Feedback Form');
    }

    /**
     * @test
     */
    public function user_can_view_feedback_list()
    {
        $feedback = factory(\App\Feedback::class)->create();
        $response = $this->get(action('FeedbackController@index'));
        $response->assertStatus(200)
                ->assertSee($feedback->id)
                ->assertSee($feedback->name)
                ->assertSee($feedback->email)
                ->assertSee($feedback->message);
    }

    /**
     * @test
     */
    public function user_can_delete_a_specific_feedback()
    {
        $feedback = factory(\App\Feedback::class)->create();

        $response = $this->get(action('FeedbackController@destroy', [$feedback->id]));

        $response->assertStatus(302)
                ->assertRedirect(action('FeedbackController@index'));

        $this->assertDatabaseMissing('feedback', [
            'id' => $feedback->id,
            'name' => $feedback->name,
            'email' => $feedback->email,
            'message' => $feedback->message
        ]);
    }

    /**
     * @test
     */
    public function user_can_create_feedback()
    {
        $feedback = factory(\App\Feedback::class)->make()->toArray();
        $feedback['g-recaptcha-response'] = '1';

        $response = $this->post(action('FeedbackController@store'), $feedback);

        $response->assertStatus(200);

        $this->assertDatabaseHas('feedback', [
           'name' => $feedback['name'],
           'email' => $feedback['email'],
           'message' => $feedback['message']
        ]);
    }

    /**
     * @test
     */
    public function user_can_not_create_feedback()
    {
        $feedback = factory(\App\Feedback::class)->make()->toArray();

        $response = $this->post(action('FeedbackController@store'), $feedback);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('feedback', [
            'name' => $feedback['name'],
            'email' => $feedback['email'],
            'message' => $feedback['message']
        ]);
    }
}
