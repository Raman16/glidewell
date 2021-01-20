<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

        $table->string('auth_type')->nullable()->default('regular');
        $table->string('auth_from')->nullable();
        $table->String('auth_id')->nullable();
        $table->string('image_url')->nullable();
        $table->string('device_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('auth_type');
                $table->dropColumn('auth_from');
                $table->dropColumn('auth_id');
                $table->dropColumn('device_id');
                $table->dropColumn('image_url');
        });
    }
}
