<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentsVerifiedToCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            // Modify the column to ensure it is a boolean and has a default value of 0 (not verified)
            $table->boolean('documents_verified')->default(0);
        });
    }

    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            // Revert the column back to its original state if necessary (you can adjust this if needed)
            $table->dropColumn('documents_verified');
        });
    }

}
