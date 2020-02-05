<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbSystemRequestLogs extends Migration
{
    public function up()
    {
        Schema::create('system_request_logs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('status_code')->nullable();
            $table->string('url')->nullable();
            $table->text('referer')->nullable();
            $table->integer('count')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('system_request_logs');
    }
}
