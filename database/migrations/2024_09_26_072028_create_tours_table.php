<?php

use App\Models\Tour;
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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('riding_style', ['Road Trip', 'Adventure', 'Enduro']);
            $table->text('riding_style_info')->nullable();
            $table->enum('rider_capability', [Tour::BEGINNER, Tour::INTERMEDIATE, Tour::EXPERT]);
            $table->text('rider_capability_info')->nullable();
            $table->integer('duration_days');
            $table->integer('rest_days')->default(0);
            $table->integer('max_riders');
            $table->integer('guides')->default(0);
            $table->enum('bike_option', [Tour::BIKE_INCLUDED, Tour::BRING_OWN_BIKE, Tour::BIKE_RENTAL])->default(Tour::BRING_OWN_BIKE);
            $table->boolean('rent_gear')->default(false);
            $table->boolean('two_up_riding')->default(false);
            $table->text('bike_specification')->nullable();
            $table->integer('tour_distance')->nullable();
            $table->string('countries');
            $table->text('included');
            $table->text('not_included');
            $table->text('map_link');
            $table->text('loation_notes');
            $table->text('video_one');
            $table->text('video_two');
            $table->text('video_three');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
