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
        if (! Schema::hasTable('listings')) {
            Schema::create('listings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->string('title');
                $table->longText('description')->nullable();
                $table->string('salary', 45)->nullable();
                $table->string('tags')->nullable();
                $table->string('company', 45)->nullable();
                $table->string('address')->nullable();
                $table->string('city', 45)->nullable();
                $table->string('state', 45)->nullable();
                $table->string('phone', 45)->nullable();
                $table->string('email', 45)->nullable();
                $table->longText('requirements')->nullable();
                $table->longText('benefits')->nullable();
                $table->timestamps();
            });

            return;
        }

        Schema::table('listings', function (Blueprint $table) {
            if (! Schema::hasColumn('listings', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
