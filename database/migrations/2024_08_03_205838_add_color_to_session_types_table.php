<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorToSessionTypesTable extends Migration
{
    public function up()
    {
        Schema::table('session_types', function (Blueprint $table) {
            $table->string('color')->default('#ffffff'); // Adiciona a coluna color com um valor padrão
        });
    }

    public function down()
    {
        Schema::table('session_types', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
}
