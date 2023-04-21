<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Mark Joseph Manalo',
            'email' => 'markjosephmanalo1110@gmail.com',
            'phone_number' => '09452692274',
            'address' => '283 Ramos Compound Baesa Quezon City',
            'password' => 'Onepiece25!',
            'gender' => 'male',
            'age' => '20',
        ]);

    }
}
