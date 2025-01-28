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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('director');
            $table->integer('year');
            $table->integer('duration');
            $table->text('description');
            $table->binary('poster');
            $table->binary('cover_image');
            $table->float('rating_average');
            $table->integer('rating_amount');
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
