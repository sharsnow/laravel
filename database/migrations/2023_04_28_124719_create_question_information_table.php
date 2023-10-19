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
        Schema::create('question_information', function (Blueprint $table) {
            $table->integer('qus_no');
            $table->string('place', 16)->collation('utf8mb4_unicode_ci');
            $table->string('topic', 16)->collation('utf8mb4_unicode_ci');
            $table->string('question', 128)->collation('utf8mb4_unicode_ci');
            $table->string('direction', 16)->default(false)->collation('utf8mb4_unicode_ci');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_information');
    }
};
