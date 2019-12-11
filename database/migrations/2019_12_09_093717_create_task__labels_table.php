<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task__labels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('label_id');
            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id')
                ->references('id')->on('tasks')
                ->onDelete('cascade');
            $table->foreign('label_id')
                ->references('id')->on('labels')
                ->onDelete('cascade');
            $table->timestamps();
            $table->index(['label_id', 'task_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task__labels');
    }
}
