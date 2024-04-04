<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id("pid");
            $table->string("title");
            $table->date("start_date");
            $table->date("end_date");
            $table->string("description");
            $table->string("phase");
            $table->bigInteger("user_uid")->unsigned();
            $table->foreign("user_uid")->references("uid")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
