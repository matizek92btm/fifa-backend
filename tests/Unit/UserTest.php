<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\UserRepository;
use Faker\Factory as Faker;

class UserTest extends TestCase
{   
    use RefreshDatabase;

    private $userRepositories;
    private $faker;

    /**
     * Set basic variables.
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->faker = Faker::create();
        $this->userRepositories = new UserRepository();
    }

    /**
     * Create user test.
     *
     * @return void
     */
    public function testCreateUser()
    { 
      $data = [
        'name' => $faker->name,
      ];
      $this->userRepositories->create($data);
      $this->assertDatabaseHas('users', $data);
    }
}
