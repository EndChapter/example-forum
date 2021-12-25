<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add categories table explained as structure
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("explanation");
            $table->timestamp("last_activity");
            // Threads of the categories will be seperated by commas.
            $table->string("thread_ids");
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
        Schema::dropIfExists('categories');
    }
}
