<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::statement("
            CREATE OR REPLACE VIEW vw_movies AS
                SELECT 
                    A.id,
                    A.title,
                    A.description,
                    A.duration,
                    A.age_classification,
                    A.year_entry,
                    B.name genre_name,
                    C.name as type_entertainment_name,
                    (SELECT count(0) FROM vote WHERE movie_id = A.id) as quantity_vote,
                    CONCAT('[', (SELECT GROUP_CONCAT(users_id) FROM vote WHERE movie_id = A.id), ']') as users_vote
                FROM 
                    movie A
                INNER JOIN
                    genre B
                ON  
                    A.genre_id = B.id
                INNER JOIN
                    type_entertainment C
                ON
                    A.type_entertainment_id = C.id
                WHERE
                    A.situation = 'A'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW vw_movies");
    }
};
