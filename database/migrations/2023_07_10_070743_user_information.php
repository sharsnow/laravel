<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('users_information', function (Blueprint $table) {
            $table->id();
            $table->string('username', 16)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('sex', 8)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('password', 128);
            $table->string('email', 34);
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
        //
    }
};
