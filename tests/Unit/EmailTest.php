<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Mail\RegistrationUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTest extends TestCase
{
    /**
     * Who the email is sent to.
     *
     * @var string
     */
    private $to;

    /**
     * From whom the email is sent.
     *
     * @var string
     */
    private $from;

    /**
     * Set basic variables.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->from = env('MAIL_FROM');
        $this->to = 'faker@gmail.com';
    }

    /**
     * Testing RegistrationUser mailable.
     *
     * @return void
     */
    public function testRegistrationUserEmail()
    {
        Mail::fake();
        Mail::to($this->to)->send(new RegistrationUser);
        Mail::assertSent(RegistrationUser::class, function ($mail) {
            $mail->build();
            return $mail->hasTo($this->to) &&
                   $mail->hasFrom($this->from) &&
                   $mail->subject === ('Witamy na portalu ' . env('APP_NAME')) &&
                   $mail->view === 'emails.registration.user';
        });
    }
}
