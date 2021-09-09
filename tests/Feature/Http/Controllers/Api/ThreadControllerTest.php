<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Jobs\DestroyMessageThreadJob;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Number;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThreadController
 */
class ThreadControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $response = $this->actingAs($this->user)->getJson(route('thread.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $number = Number::factory()->create([
            'user_id' => $this->user->id
        ]);
        $myNumber = $number->phone_number;
        $contactNumber = $this->faker->e164PhoneNumber;
        $contact = Contact::factory()->create([
            'user_id' => $this->user->id,
            'phone_numbers' => ['mobile' => $contactNumber]
        ]);
        $date = now()->subDays(7);

        foreach(range(0,9) as $i){

            if($i % 2 == 0){
                $from = $contactNumber;
                $to = $myNumber;
            } else {
                $from = $myNumber;
                $to = $contactNumber;
            }

            Message::factory()->create([
                'user_id' => $this->user->id,
                'number_id' => $number->id,
                'contact_id' => $contact->id,
                'from' => $from,
                'to' => $to,
                'created_at' => $date->addMinutes($i),
                'updated_at' => $date->addMinutes($i)
            ]);
        }

        $response = $this->actingAs($this->user)
            ->getJson(route('thread.show', ['phoneNumber' => $contactNumber]));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $myNumber = $this->faker->e164PhoneNumber;
        $contactNumber = $this->faker->e164PhoneNumber;
        $contact = Contact::factory()->create([
            'user_id' => $this->user->id,
            'phone_numbers' => ['mobile' => $contactNumber]
        ]);
        $a = Message::factory()->create([
            'user_id' => $this->user->id,
            'contact_id' => $contact->id,
            'from' => $contactNumber,
            'to' => $myNumber
        ]);
        $b = Message::factory()->create([
            'user_id' => $this->user->id,
            'contact_id' => $contact->id,
            'from' => $myNumber,
            'to' => $contactNumber
        ]);

        $response = $this->actingAs($this->user)
            ->deleteJson(route('thread.destroy', ['phoneNumber' => $contactNumber]));

        $response->assertNoContent();

        $this->assertDeleted($a);
        $this->assertDeleted($b);
    }
}
