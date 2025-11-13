<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    	if(!Schema::hasColumn('policy_leads','status')){
            Schema::table('policy_leads', function (Blueprint $table) {
                $table->tinyInteger('status')->nullable()->default(0)->after('accessibility_suggestions');
            });
    	}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('policy_leads', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
