<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentFormatToDocumentTypesTable extends Migration
{
    public function up()
{
    if (!Schema::hasColumn('document_types', 'document_format')) {
        Schema::table('document_types', function (Blueprint $table) {
            $table->unsignedTinyInteger('document_format')->default(1)->comment('1 = PDF, 2 = Image');
        });
    }
}

public function down()
{
    if (Schema::hasColumn('document_types', 'document_format')) {
        Schema::table('document_types', function (Blueprint $table) {
            $table->dropColumn('document_format');
        });
    }
}

}
