<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_anime_list_animes', function (Blueprint $table) {
            // Only reason we have those values persisted is to reduce the stress on the API
            // if we need to work with the data
            // Securing the types of the values will happen later
            $table->id();
            $table->integer('mal_id');
            $table->string('title');
            $table->json('main_picture')->nullable();
            $table->json('alternative_titles')->nullable();
            $table->string('start_date')->nullable();
            $table->json('synopsis')->nullable();
            $table->float('mean')->nullable();
            $table->integer('rank')->nullable();
            $table->integer('popularity')->nullable();
            $table->integer('num_list_users')->nullable();
            $table->integer('num_scoring_users')->nullable();
            $table->string('nsfw')->nullable();
            $table->string('mal_created_at')->nullable();
            $table->string('mal_updated_at')->nullable();
            $table->string('media_type')->nullable();
            $table->string('status')->nullable();
            $table->json('genres')->nullable();
            $table->integer('num_episodes')->nullable();
            $table->json('start_season')->nullable();
            $table->json('broadcast')->nullable();
            $table->string('source')->nullable();
            $table->string('mal_updated_at')->nullable();
            $table->string('mal_updated_at')->nullable();
            $table->string('mal_updated_at')->nullable();
            $table->integer('average_episode_duration')->nullable();
            $table->string('rating')->nullable();
            $table->json('pictures')->nullable();
            $table->string('background')->nullable();
            $table->json('related_anime')->nullable();
            $table->json('related_manga')->nullable();
            $table->json('recommendations')->nullable();
            $table->json('studios')->nullable();
            $table->json('statistics')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_anime_list_animes');
    }
};
