<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('team')->insert([
            [
                'name' => 'Andromeda',
                'photo' => 'Andromeda.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cassiopeia',
                'photo' => 'Cassiopeia.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dipper',
                'photo' => 'Dipper.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Hydrus',
                'photo' => 'Hydrus.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lyra',
                'photo' => 'Lyra.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Octans',
                'photo' => 'Octans.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Orion',
                'photo' => 'Orion.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
             [
                'name' => 'Pegasus',
                'photo' => 'Pegasus.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
             ],
            [
                'name' => 'Perseus',
                'photo' => 'Perseus.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ursa',
                'photo' => 'Ursa.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
