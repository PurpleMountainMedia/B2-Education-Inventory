<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMakeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

            Schema::create('makes', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('school_id')->nullable()->default(null);
                $table->string('name')->nullable();
                $table->string('description')->nullable();
                $table->uuid('created_by')->nullable()->default(null);
                $table->softDeletes();
                $table->nullableTimestamps();
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
        Schema::dropIfExists('makes');
    }
}
