<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(AdminAccountSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(ClassificationSeeder::class);
        $this->call(ClassificationPointSeeder::class);
        $this->call(ScheduleSeeder::class);

    }
}
