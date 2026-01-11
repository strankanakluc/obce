<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToStatesTable extends Migration
{
    public function up()
    {
        Schema::table('states', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('country_id');
            $table->index('parent_id');
            $table->foreign('parent_id')->references('id')->on('states')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('states', function (Blueprint $table) {
            // Niektoré DB vyžadujú kontrolu existencie; uprav podľa potreby.
            $table->dropForeign(['parent_id']);
            $table->dropIndex(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }
}