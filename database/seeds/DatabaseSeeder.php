<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(PremierLeagueSeeder::class);
         $this->call(PremierLeagueTeamsSeeder::class);
         $this->call(RolesSeeder::class);
    }
}
