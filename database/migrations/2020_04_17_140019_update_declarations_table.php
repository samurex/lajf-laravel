<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDeclarationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('declarations', function (Blueprint $table) {
            $table->dropColumn('question_1');
            $table->dropColumn('question_2');
            $table->dropColumn('question_3');
            $table->dropColumn('temperature');
            $table->integer('mood_id');
            $table->integer('scale');
            $table->text('feelings')->nullable(true);
            $table->boolean('share')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('declarations', function (Blueprint $table) {
            $table->string('question_1')->nullable();
            $table->string('question_2')->nullable();
            $table->string('question_3')->nullable();
            $table->string('temperature')->nullable(false);
            $table->dropColumn('mood_id');
            $table->dropColumn('scale');
            $table->dropColumn('feelings');
            $table->dropColumn('share');
        });
    }
}
