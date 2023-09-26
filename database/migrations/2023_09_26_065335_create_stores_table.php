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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id');

            $table->string('name', 50);
            $table->string('identifier', 120)->nullable();
            $table->text('description')->nullable();
            $table->string('store_location')->nullable();
            $table->boolean('is_active')->default(true);

            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->restrictOnDelete()
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
