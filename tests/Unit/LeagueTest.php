<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LeagueTest extends TestCase
{   
    use DatabaseTransactions;

    /**
     * Test function to check if Premier League exists in Leagues table. 
     *
     * @return void
     */
    public function testPremierLeague()
    {   
        $premierLeague = [
            'name' => 'Premier League',
            'logo' => 'images/leagues/premier_league.png',
            'bonus' => 1,
        ];

        $this->assertDatabaseHas('leagues', $premierLeague);
    }
}
