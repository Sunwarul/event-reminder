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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_id');
            $table->string('name');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('organizer')->nullable();
            $table->enum('type', array_column(\App\Enums\EventTypeEnum::cases(), 'value'))->nullable();
            $table->string('url')->nullable(); // URL for more information or registration
            $table->string('image')->nullable(); // URL to an image representing the event
            $table->string('created_by')->nullable(); // User who created the event
            $table->enum('status', array_column(\App\Enums\EventStatusEnum::cases(), 'value'))->default(\App\Enums\EventStatusEnum::SCHEDULED);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
