<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

            Schema::create('item_types', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('organisation_id')->nullable()->default(null);
                $table->uuid('make_id')->nullable();
                $table->string('name')->nullable();
                $table->string('description')->nullable();
                $table->uuid('created_by')->nullable()->default(null);
                $table->softDeletes();
                $table->nullableTimestamps();

                $table->foreign('make_id')
                    ->references('id')->on('makes')
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
        Schema::dropIfExists('item_types');
    }
}
