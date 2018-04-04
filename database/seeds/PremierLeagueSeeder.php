<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PremierLeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $premierLeague = [
            'name' => 'Premier League',
            'logo' => 'images/leagues/premier_league.png',
            'bonus' => 1,
            'created_at' => Carbon::now(),
        ];

        DB::table('leagues')->insert($premierLeague);
    }
}
