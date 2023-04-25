<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW list_of_score AS
            SELECT team.name as team_name,team.photo , event.name as event_name, classification_pointing.position,classification_pointing.score FROM `score`
            LEFT JOIN team on score.team_id = team.id
            LEFT JOIN event on score.event_id = event.id
            LEFT JOIN classification_pointing on score.classification_pointing_id =  classification_pointing.id;"
         );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW list_of_score_view");
    }
};
