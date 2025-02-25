<?php

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->boolean('decision_made')->default(0);
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

        DB::statement('ALTER TABLE reports ADD CONSTRAINT check_user_or_review CHECK (
            (user_id IS NOT NULL AND review_id IS NULL) OR (user_id IS NULL AND review_id IS NOT NULL)
        )');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
}
