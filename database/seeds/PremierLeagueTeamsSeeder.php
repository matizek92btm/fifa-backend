<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PremierLeagueTeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //Premier League
        $premierLeague = DB::table('leagues')->select('id')->where('name', 'Premier League')->first();
        //Premier Leage Teams for season 2017/2018.
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
                'created_at' => Carbon::now(),
            ];

            $result_id = DB::table('teams')->insertGetId($team);
        
            $league_team = [
                'league_id' => $premierLeague->id,
                'team_id' => $result_id,
            ];

            DB::table('league_team')->insert($league_team);
        }
    }
}
