<?php

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->boolean('decision_made')->default(0);

            // Correct way to make foreign keys nullable with foreignIdFor in Laravel 11
            $table->foreignIdFor(Review::class)
                ->nullable() // Makes the foreign key optional
                ->constrained()
                ->onDelete('cascade');
                
            $table->foreignIdFor(User::class)
                ->nullable() // Makes the foreign key optional
                ->constrained()
                ->onDelete('cascade');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
}
