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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('asset_id');
            $table->integer('price');
            $table->tinyInteger('status')->default(1);
            $table->boolean('all_day')->nullable();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('title');
            $table->string('URL')->nullable();
            $table->string('class_names')->nullable();
            $table->boolean('editable');
            $table->boolean('start_editable');
            $table->boolean('duration_editable');
            $table->boolean('resource_editable');
            $table->string('display');
            $table->boolean('overlap');
            $table->string('event_constraint');
            $table->string('background_color');
            $table->string('text_color');
            $table->string('border_color');
            $table->text('extended_props');
            $table->string('source');
            $table->timestamps();
            $table->index(['user_id', 'status']);
            $table->index(['asset_id', 'status']);
            $table->index(['asset_id', 'status', 'start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
