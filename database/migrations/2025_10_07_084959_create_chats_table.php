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
        // Schema::create('chats', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('wa_id');
        //     $table->string('sender')->nullable();
        //     $table->text('message');
        //     $table->string('direction')->default('in');
        //     $table->timestamps();
        // });

        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('wa_id');
            $table->string('sender');
            $table->text('message');
            $table->enum('direction', ['in', 'out']);
            $table->foreignId('handled_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};