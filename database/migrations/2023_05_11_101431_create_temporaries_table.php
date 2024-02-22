<?php

namespace App\Services\AccountService\V1\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the Database.
     */
    public function up(): void
    {
        Schema::create('temporaries', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->nullable();
            $table->integer('code')->nullable();
            $table->tinyInteger('retries');
            $table->dateTime('send_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the Database.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporaries');
    }
};
