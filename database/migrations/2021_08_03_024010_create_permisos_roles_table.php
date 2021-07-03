<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisosRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_permisos');	
            $table->unsignedBigInteger('id_roles');	
            $table->timestamps();
            $table->foreign('id_permisos')->references('id')->on('permisos');
            $table->foreign('id_roles')->references('id')->on('roles');

        });
        // Schema::table('permisos_roles', function($table) {
        //     $table->foreign('id_permisos')->references('id')->on('permisos');
        //     $table->foreign('id_roles')->references('id')->on('roles');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos_roles');
    }
}
