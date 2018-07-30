<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

            Schema::create('rooms', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('building_id');
                $table->string('name')->nullable();
                $table->string('type')->nullable();
                $table->text('meta')->nullable();
                $table->uuid('created_by')->nullable()->default(null);
                $table->softDeletes();
                $table->nullableTimestamps();

                $table->foreign('building_id')
                    ->references('id')->on('buildings')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
