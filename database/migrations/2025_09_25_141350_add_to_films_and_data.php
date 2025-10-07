<?php

use App\Models\Film;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('film', function (Blueprint $table) {
            $table->string('slug')->index('film_slug');
        });


       $films= Film::query()->get();
       foreach ($films as $film) {
           $film = film::query()->find($film->film_id);
           $film->slug= str::slug($film->title);
           $film->save();
       }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('film', function (Blueprint $table) {
            $table->dropIndex('film_slug');
        });

        Schema::table('film', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
