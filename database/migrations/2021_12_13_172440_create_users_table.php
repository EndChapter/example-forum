<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("nickname");
            $table->string("password");
            $table->string("email")->unique();
            $table->boolean("is_mail_hidden");
            $table->boolean("is_moderator");
            $table->boolean("is_admin");
            $table->boolean("is_founder");
            $table->timestamp("last_activity");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
