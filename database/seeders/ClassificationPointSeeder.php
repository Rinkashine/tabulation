<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClassificationPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classification_pointing')->insert([
            //Begin: Mr. and Ms. Sportfest
            [
                'classification_id' => 1,
                'position' => 'Champion',
                'score' => 1000,
            ],[
                'classification_id' => 1,
                'position' => 'First Runner up',
                'score' => 750,
            ],[
                'classification_id' => 1,
                'position' => 'Second Runner Up',
                'score' => 500,
            ],[
                'classification_id' => 1,
                'position' => 'Participation',
                'score' => 250,
            ],[
                'classification_id' => 1,
                'position' => 'No Participation',
                'score' => 0,
            ],
            //End: Mr. and Ms Sportfest
            //Begin: Cheerdance
            [
                'classification_id' => 2,
                'position' => 'Champion',
                'score' => 1000,
            ],[
                'classification_id' => 2,
                'position' => 'First Runner up',
                'score' => 750,
            ],[
                'classification_id' => 2,
                'position' => 'Second Runner Up',
                'score' => 500,
            ],[
                'classification_id' => 2,
                'position' => 'Participation',
                'score' => 250,
            ],[
                'classification_id' => 2,
                'position' => 'No Participation',
                'score' => 0,
            ],
            //End: Cheer Dance
            //Begin: Major Events
            [
                'classification_id' => 3,
                'position' => 'Champion',
                'score' => 500,
            ],[
                'classification_id' => 3,
                'position' => 'First Runner up',
                'score' => 300,
            ],[
                'classification_id' => 3,
                'position' => 'Second Runner Up',
                'score' => 200,
            ],[
                'classification_id' => 3,
                'position' => 'Participation',
                'score' => 100,
            ],[
                'classification_id' => 3,
                'position' => 'No Participation',
                'score' => 0,
            ],
            //End: Major Events
            //Begin: Esports
            [
                'classification_id' => 4,
                'position' => 'Champion',
                'score' => 350,
            ],[
                'classification_id' => 4,
                'position' => 'First Runner up',
                'score' => 200,
            ],[
                'classification_id' => 4,
                'position' => 'Second Runner Up',
                'score' => 100,
            ],[
                'classification_id' => 4,
                'position' => 'Participation',
                'score' => 50,
            ],[
                'classification_id' => 4,
                'position' => 'No Participation',
                'score' => 0,
            ],
            //End: Esports
            //Begin: Larong Lahi
            [
                'classification_id' => 5,
                'position' => 'Champion',
                'score' => 300,
            ],[
                'classification_id' => 5,
                'position' => 'First Runner up',
                'score' => 150,
            ],[
                'classification_id' => 5,
                'position' => 'Second Runner Up',
                'score' => 75,
            ],[
                'classification_id' => 5,
                'position' => 'Participation',
                'score' => 30,
            ],[
                'classification_id' => 5,
                'position' => 'No Participation',
                'score' => 0,
            ],
            //End: Larong Lahi
            //Begin: Minor Events
            [
                'classification_id' => 6,
                'position' => 'Champion',
                'score' => 250,
            ],[
                'classification_id' => 6,
                'position' => 'First Runner up',
                'score' => 100,
            ],[
                'classification_id' => 6,
                'position' => 'Second Runner Up',
                'score' => 50,
            ],[
                'classification_id' => 6,
                'position' => 'Participation',
                'score' => 25,
            ],[
                'classification_id' => 6,
                'position' => 'No Participation',
                'score' => 0,
            ],
            //End: Minor Events


        ]);
    }
}
