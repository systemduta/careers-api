<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisions')->insert([
            [
                'name'  => 'People System',
                'code'  => 'PS'
            ],
            [
                'name'  => 'Digital & IT',
                'code'  => 'DIT'
            ],
            [
                'name'  => 'Business Development',
                'code'  => 'BD'
            ],
            [
                'name'  => 'Finance',
                'code'  => 'FC'
            ],
            [
                'name'  => 'Tax',
                'code'  => 'TX'
            ]

        ]);
    }
}
