<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add threads table explained as structure
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->string("topic");
            $table->string("explanation");
            $table->integer("views");
            $table->string("nickname");
            //ids of the replies will be seperated by commas
            $table->string("reply_ids")->default("");
            $table->boolean("is_pinned");
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
        Schema::dropIfExists('threads');
    }
}
