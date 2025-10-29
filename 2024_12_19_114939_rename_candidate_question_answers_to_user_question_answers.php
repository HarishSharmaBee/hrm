<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, drop the foreign key constraints
        Schema::table('candidate_question_answers', function (Blueprint $table) {
            $table->dropForeign(['candidate_id']);
            $table->dropForeign(['question_id']);
        });

        // Now drop the indexes
        Schema::table('candidate_question_answers', function (Blueprint $table) {
            $table->dropIndex('candidate_question_answers_candidate_id_foreign');
            $table->dropIndex('candidate_question_answers_question_id_foreign');
        });

        // Rename the table
        Schema::rename('candidate_question_answers', 'user_question_answers');

        // Modify the column
        DB::statement('ALTER TABLE user_question_answers CHANGE COLUMN candidate_id user_id BIGINT(20) UNSIGNED NOT NULL');

        // Modify the table to reflect the changes
        Schema::table('user_question_answers', function (Blueprint $table) {
            // Add the new foreign key relationships
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the foreign key constraints
        Schema::table('user_question_answers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['question_id']);
        });

        // Rename the table back to the original name
        Schema::rename('user_question_answers', 'candidate_question_answers');

        // Modify the column to revert the changes
        DB::statement('ALTER TABLE candidate_question_answers CHANGE COLUMN user_id candidate_id BIGINT(20) UNSIGNED NOT NULL');

        // Add the original foreign key indexes
        Schema::table('candidate_question_answers', function (Blueprint $table) {
            $table->index('candidate_id', 'candidate_question_answers_candidate_id_foreign');
            $table->index('question_id', 'candidate_question_answers_question_id_foreign');
        });

        // Recreate the foreign key relationships (if needed, based on original table structure)
        Schema::table('candidate_question_answers', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }
};
