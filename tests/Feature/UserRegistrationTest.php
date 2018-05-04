<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    private $mockActiveRepository;
    private $mockUserRepository;

    /**
     * Basic setup.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->mockActiveRepository = $this->mock('App\Contracts\Repositories\ActiveRepositoryInterface');
        $this->mockUserRepository = $this->mock('App\Contracts\Repositories\UserRepositoryInterface');
    }

    /**
     * Mocker.
     *
     * @param string $class
     * @param boolean $appInstance
     * @return object
     */
    public function mock(string $class, $appInstance = true)
    {
        $mock = \Mockery::mock($class);
        $this->app->instance($class, $mock);

        return $mock;
    }
    /**
     * User should register account.
     *
     * @return void
     */
    public function testUserRegistrationSucceess()
    {
        //Prepare all moks for tests.
        $this->mockUserRepository->shouldReceive('create')->once()->andReturnUsing(function () {
            $user = new \App\Models\User;
            $user->id = 1;
            $user->nick = $this->faker->firstName;
            $user->email = $this->faker->email;

            return $user;
        });
        $this->mockActiveRepository->shouldReceive('create')->once()->andReturnUsing(function () {
            $active = new \App\Models\Active;
            $active->token = str_random(64);

            return $active;
        });

        //Imitate requset data.
        $userForm = [
            'team_id' => 1,
            'nick' => $this->faker->firstName,
            'nick_game' => $this->faker->lastName,
            'email' => $this->faker->email,
            'skype' => $this->faker->word,
            'password' => $this->faker->password,
        ];

        //When user send form with information
        $response = $this->call('post', route('users.register'), $userForm);
        //Then user should get response 200 with correct text.
        $this->assertEquals(200, $response->status());
        $this->assertEquals(__('registration.success'), $response->original['responseText']);
    }

    /**
     * User should confirmation account.
     *
     * @return void
     */
    public function testUserRegistrationAccountConfirmationSuccess()
    {
        //Prepare all moks for tests.
        $this->mockUserRepository->shouldReceive('edit')->once()->andReturnUsing(function () {
            $user = new \App\Models\User;

            return $user;
        });
        $this->mockActiveRepository->shouldReceive('findByToken')->once()->andReturnUsing(function () {
            $active = new \App\Models\Active;
            $active->id = 1;
            $active->user_id = 1;

            return $active;
        });
        $this->mockActiveRepository->shouldReceive('delete')->once()->andReturn(true);

        //Imitate requset data.
        $token = ['token' => $this->faker->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}')];

        //When user click on link with token on his email account
        $response = $this->call('get', route('users.register.confirm'), $token);
        //Then user should get response 200 with correct text.
        $this->assertEquals(200, $response->status());
        $this->assertEquals(__('registration.accountConfirmationSuccess'), $response->original['responseText']);
    }

    /**
     * User should get info that token is not longer valid
     *
     * @return void
     */
    public function testUserRegistrationAccountConfirmationFailed()
    {
        //Prepare all moks for tests.
        $this->mockActiveRepository->shouldReceive('findByToken')->once()->andReturn(false);

        //Imitate requset data.
        $token = ['token' => $this->faker->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}')];

        //When user click on link with token on his email which was used.
        $response = $this->call('get', route('users.register.confirm'), $token);
        //Then user should get response 200 with correct text.
        $this->assertEquals(200, $response->status());
        $this->assertEquals(__('registration.accountConfirmationTokenFailed'), $response->original['responseText']);
    }

    /**
     * User should get info that token value is empty
     *
     * @return void
     */
    public function testUserRegistrationAccountConfirmationTokenEmpty()
    {
        $response = $this->call('get', route('users.register.confirm'));
        //Then user should get response 200 with correct text.
        $this->assertEquals(200, $response->status());
        $this->assertEquals(__('registration.accountConfirmationTokenEmpty'), $response->original['responseText']);
    }
}
