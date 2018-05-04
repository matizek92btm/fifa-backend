<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecoveryPasswordTest extends TestCase
{
    use WithFaker;

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
     * Test recovery password.
     *
     * @return void
     */
    public function testPasswordRecovery()
    {
        //Prepare all moks for tests.
        $this->mockUserRepository->shouldReceive('findByEmail')->once()->andReturnUsing(function () {
            $user = new \App\Models\User;
            $user->id = 1;
            $user->nick = $this->faker->firstName;
            $user->email = $this->faker->email;

            return $user;
        });

        $this->mockUserRepository->shouldReceive('deletePasswordRecovery')->once()->andReturn(true);

        $this->mockUserRepository->shouldReceive('passwordRecovery')->once()->andReturn(true);

        //Imitate requset data.
        $passwordRecoveryForm = [
            'email' => $this->faker->email,
        ];

        //When user send form with information
        $response = $this->call('post', route('users.password.recovery'), $passwordRecoveryForm);

        //Then user should get response 200 with correct text.
        $this->assertEquals(200, $response->status());
        $this->assertEquals(__('user.passswordRecoveryDone'), $response->original['responseText']);
    }

    /**
     * Test password recovery when user pass bad email.
     */
    public function testPasswordRecoveryFailed()
    {
        //Prepare mocks.
        $this->mockUserRepository->shouldReceive('findByEmail')->once()->andReturn(null);

        //Imitate requset data.
        $passwordRecoveryForm = [
            'email' => $this->faker->email,
        ];

        //When user send form with information with email that don't exists.
        $response = $this->call('post', route('users.password.recovery'), $passwordRecoveryForm);

        //Then user should get response 200 with correct text.
        $this->assertEquals(200, $response->status());
        $this->assertEquals(__('user.passwordRecoveryBadEmail'), $response->original['responseText']);
    }

    /**
     * Test password change.
     */
    public function testPasswordChange()
    {

        //Prepare mocks.
        $this->mockUserRepository->shouldReceive('findEmailByPasswordRecoveryToken')->once()->andReturnUsing(function () {
            $data = new \Illuminate\Database\Eloquent\Collection();
            $data->email = $this->faker->email;

            return $data;
        });

        $this->mockUserRepository->shouldReceive('findByEmail')->once()->andReturnUsing(function () {
            $user = new \App\Models\User;
            $user->id = 1;
            $user->nick = $this->faker->firstName;
            $user->email = $this->faker->email;

            return $user;
        });

        $this->mockUserRepository->shouldReceive('edit')->once()->andReturn(true);
        $this->mockUserRepository->shouldReceive('deletePasswordRecovery')->once()->andReturn(true);

        //Imitate requset data.
        $changePasswordForm = [
            'token' => $this->faker->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'),
            'password' => $this->faker->password,
        ];

        //When user change password in form.
        $response = $this->call('get', route('users.password.change'), $changePasswordForm);

        //Then user should get response 200 with correct text.
        $this->assertEquals(200, $response->status());
        $this->assertEquals(__('user.passwordChangeDone'), $response->original['responseText']);
    }

    /**
     * Test password change when token is bad.
     */
    public function testPasswordChangeFailed()
    {
        //Prepare mocks.
        $this->mockUserRepository->shouldReceive('findEmailByPasswordRecoveryToken')->once()->andReturn(null);

        //Imitate requset data.
        $changePasswordForm = [
            'token' => $this->faker->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'),
            'password' => $this->faker->password,
        ];

        //When user change password in form.
        $response = $this->call('get', route('users.password.change'), $changePasswordForm);

        //Then user should get response 200 with correct text.
        $this->assertEquals(200, $response->status());
        $this->assertEquals(__('user.passwordChangeFailToken'), $response->original['responseText']);

    }
}
