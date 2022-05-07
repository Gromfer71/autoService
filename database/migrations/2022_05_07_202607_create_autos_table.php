<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('autos', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('number')->nullable();
            $table->boolean('is_busy')->default(false);
            $table->foreignIdFor(\App\Models\User::class)->nullable();
            $table->dateTime('busy_until')->nullable();
            $table->integer('cost')->default(5);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('autos');
    }
};
