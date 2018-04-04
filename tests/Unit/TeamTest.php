<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPremierLeague()
    {   
        $premierLeagueTeams = [
            'Arsenal' => 15,
            'AFC Bournemouth' => 20,
            'Brighton and Hove Albion' => 20,
            'Burnley' => 20,
            'Chelsea' => 10,
            'Crystal Palace' => 20,
            'Everton' => 15,
            'Huddersfield Town' => 25,
            'Leicester City' => 20,
            'Liverpool' => 15,
            'Manchester City' => 10,
            'Manchester United' => 10,
            'Newcastle United' => 20,
            'Southampton' => 20,
            'Stoke City' => 20,
            'Swansea City' => 20,
            'Tottenham Hotspur' => 10,
            'Watford' => 20,
            'West Bromwich Albion' => 20,
            'West Ham United' => 20,
        ];

        foreach ($premierLeagueTeams as $name => $bonus) {
            $team = [
                'name' => $name,
                'logo' => '/images/teams/premier_league/' . strtolower(str_replace(' ', '_', $name)) . '.png',
                'bonus' => $bonus,
            ];
            $this->assertDatabaseHas('Teams', $team);
        }
    }
}
