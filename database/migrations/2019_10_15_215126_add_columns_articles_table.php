<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('direccion');
            $table->string('produccion');
            $table->string('post_produccion');
            $table->string('fotografo');
            $table->dropColumn('tipo_material');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('direccion');
            $table->dropColumn('produccion');
            $table->dropColumn('post_produccion');
            $table->dropColumn('fotografo');
            $table->string('tipo_material');
        });
    }
}
