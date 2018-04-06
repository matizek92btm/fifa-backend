<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    /**
     * User should register account.
     *
     * @return void
     */
    public function testUserRegistration()
    {
        //When I send form with user information
        $user = [
            'team_id' => 1,
            'nick' => $this->faker->firstName,
            'nick_game' => $this->faker->lastName,
            'email' => $this->faker->email,
            'skype' => $this->faker->word,
            'password' => $this->faker->password,
        ];
        $response = $this->post(route('users.register'), $user);
        
        //Then account should be saved in database
        unset($user['password']);
        $this->assertDatabaseHas('users', $user);

        //And user should get response 200 with user account
        $this->assertEquals(200, $response->status());
        unset($user['team_id']);
        foreach ($user as $key => $val) {
            $this->assertArrayHasKey($key, $response->decodeResponseJson());
        }
    }
}
