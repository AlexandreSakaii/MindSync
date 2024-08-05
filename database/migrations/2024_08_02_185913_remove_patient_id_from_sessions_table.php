<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePatientIdFromSessionsTable extends Migration
{
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropColumn('patient_id');
        });
    }

    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->unsignedBigInteger('patient_id');

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }
}
