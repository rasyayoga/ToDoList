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
        Schema::create('todolists', function (Blueprint $table) {
            $table->id();
            $table->string("task");
            $table->boolean("is_done")->default(false);
            //fungsi ini berguna jika user_id tidak ditemukanmaka data table todolist akan dihapus
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users') 
                ->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todolists');
    }
};
