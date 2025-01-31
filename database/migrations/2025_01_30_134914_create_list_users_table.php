<?php

use App\Models\MovieList;
use App\Models\User;
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
        Schema::create('list_users', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['pending', 'accepted']);
            $table->enum('role', ['owner', 'collaborator']);
            $table->foreignIdFor(MovieList::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_users');
    }
};
