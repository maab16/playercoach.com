<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbBackendUserGroups extends Migration
{
    public function up()
    {
        Schema::create('backend_user_groups', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->unique('name_unique');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('backend_user_groups');
    }
}
