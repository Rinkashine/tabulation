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
        DB::statement('DROP VIEW overall');
        DB::statement("CREATE VIEW overall AS
          SELECT team_name,sum(score) as overall, RANK() OVER(order by overall desc) as rank FROM `list_of_score` GROUP BY team_name;"
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
