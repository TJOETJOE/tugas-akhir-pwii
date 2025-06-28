<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matpel', function (Blueprint $table) {
    $table->id(); // -> BIGINT UNSIGNED
    $table->string('nama_matpel');
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('matpel');
    }
};