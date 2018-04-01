<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;


class EmailTest extends TestCase
{   
    private $testingEmailAddress = 'mateusz.kaleta92@gmail.com';

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSendEamil()
    {
        Mail::fake();
        Mail::assertSent(RegistrationUser::class);
    }
}
