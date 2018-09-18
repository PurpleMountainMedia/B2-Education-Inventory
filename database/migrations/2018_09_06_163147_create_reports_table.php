<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('created_by')->nullable()->default(null);
            $table->uuid('school_id')->nullable()->default(null);
            $table->uuid('parent_id')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
            $table->string('template')->nullable()->default(null);
            $table->json('query')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->integer('repeat_every');
            $table->string('repeat_every_unit');
            $table->boolean('notifications');
            $table->json('data');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
