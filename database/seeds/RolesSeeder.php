<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Administrator', 'Moderator', 'Redaktor', 'User'];
        foreach ($roles as $role){
            DB::table('roles')->insert([
                'name' => $role,
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:m:s'),
            ]);
        }
    }
}
