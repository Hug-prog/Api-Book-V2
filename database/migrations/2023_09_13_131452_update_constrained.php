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
        Schema::table("book_tag", function (Blueprint $table) {
            $table
                ->foreign("book_id")
                ->references("id")
                ->on("books")
                ->cascadeOnDelete();
            $table
                ->foreign("tag_id")
                ->references("id")
                ->on("tags")
                ->cascadeOnDelete();
        });
        Schema::table("comments", function (Blueprint $table) {
            $table
                ->foreign("book_version_id")
                ->references("id")
                ->on("book_versions")
                ->cascadeOnDelete();
        });
        Schema::table("book_version_user", function (Blueprint $table) {
            $table
                ->foreign("book_version_id")
                ->references("id")
                ->on("book_versions")
                ->cascadeOnDelete();
            $table
                ->foreign("user_id")
                ->references("id")
                ->on("users")
                ->cascadeOnDelete();
        });
        Schema::table("books", function (Blueprint $table) {
            $table
                ->foreign("author_id")
                ->references("id")
                ->on("authors")
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("book_tag", function (Blueprint $table) {
            $table->dropForeign("book_id");

            $table->dropForeign("tag_id");
        });
        Schema::table("comments", function (Blueprint $table) {
            $table->dropForeign("book_version_id");
        });
        Schema::table("book_version_user", function (Blueprint $table) {
            $table->dropForeign("book_version_id");
            $table->dropForeign("user_id");
        });
        Schema::table("books", function (Blueprint $table) {
            $table->dropForeign("author_id");
        });
    }
};
