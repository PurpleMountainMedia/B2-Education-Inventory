<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

            Schema::create('items', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('room_id');
                $table->uuid('make_id')->nullable();
                $table->uuid('item_type_id');
                $table->string('barcode')->nullable();
                $table->string('name')->nullable();
                $table->string('description')->nullable();
                $table->string('serial_number')->nullable();
                $table->integer('purchase_price')->nullable();
                $table->dateTime('purchase_date')->nullable();
                $table->text('meta')->nullable();
                $table->uuid('created_by')->nullable()->default(null);
                $table->timestamp('write_off')->nullable()->default(null);
                $table->timestamp('missing_at')->nullable()->default(null);
                $table->softDeletes();
                $table->nullableTimestamps();

                $table->foreign('room_id')
                    ->references('id')->on('rooms')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->foreign('item_type_id')
                    ->references('id')->on('item_types')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

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
        Schema::dropIfExists('items');
    }
}
