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


        DB::statement("CREATE VIEW overall AS
            SELECT team.name as team_name, team.photo,
            COALESCE(sum(classification_pointing.score),0) as overall,
            RANK() OVER(order by overall desc) as rank
            FROM `team`
            LEFT JOIN score ON score.team_id = team.id
            LEFT JOIN classification_pointing ON score.classification_pointing_id = classification_pointing.id
            GROUP BY team.name,team.photo;"
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::statement('DROP VIEW overall');
    }
};
