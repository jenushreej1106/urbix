<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {

            $table->id();

            $table->string('complaint_id')->unique();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('category');

            $table->string('title');

            $table->text('description');

            $table->string('image')->nullable();

            $table->string('location');

            $table->decimal('latitude', 10, 7)->nullable();

            $table->decimal('longitude', 10, 7)->nullable();

            $table->enum('status', [
                'Pending',
                'Processing',
                'Resolved',
                'Rejected'
            ])->default('Pending');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};