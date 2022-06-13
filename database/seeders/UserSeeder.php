<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      => 'Administrator',
            'email'     => 'admin.careers@maesagroup.com',
            'password'  => bcrypt('password'),
            'division_id'  => 1,
            'role'      => 'admin'
        ]);
    }
}
