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
    Schema::table('vins', function (Blueprint $table) {
        $table->dropColumn('categorie');
    });
}

public function down()
{
    Schema::table('vins', function (Blueprint $table) {
        $table->string('categorie')->nullable();
    });
}
};
