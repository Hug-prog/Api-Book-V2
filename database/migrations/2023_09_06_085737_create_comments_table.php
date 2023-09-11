<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("comments", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("comment");
            $table->integer("note");
            $table
                ->foreignId("statut_id")
                ->nullable()
                ->onDelete("cascade");
            $table->foreignId("user_id");
            $table->foreignId("book_version_id")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("comments");
    }
};
