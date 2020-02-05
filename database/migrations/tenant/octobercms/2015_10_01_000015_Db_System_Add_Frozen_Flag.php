<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbSystemAddFrozenFlag extends Migration
{
    public function up()
    {
        Schema::table('system_plugin_versions', function (Blueprint $table) {
            $table->boolean('is_frozen')->default(0);
        });
    }

    public function down()
    {
        Schema::table('system_plugin_versions', function (Blueprint $table) {
            $table->dropColumn('is_frozen');
        });
    }
}
