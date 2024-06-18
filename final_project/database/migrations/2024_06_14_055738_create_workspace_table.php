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
        Schema::create('workspace', function (Blueprint $table) {
            $table->id();
            $table->string('name',16);
            $table->text('description');
            $table->integer('task_number');
            $table->unsignedBigInteger('task_details_id')->nullable();
            $table->timestamps();
            $table->foreign('task_details_id')->references('id')->on('task_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workspace');
    }
};
