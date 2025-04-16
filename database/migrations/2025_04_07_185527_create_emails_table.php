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
        Schema::create('emails', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("subject");
            $table->text("to");
            $table->text("cc")->nullable();
            $table->text("bcc")->nullable();
            $table->text("body");
            $table->text("attachments");
            $table->bigInteger("user_id")->references("id")->on("users");
            $table->string("user_name");
            $table->string("system_name");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
