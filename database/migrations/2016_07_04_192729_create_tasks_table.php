<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('tasks', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('project_id')->unsigned();
			$table->foreign('project_id')->references('id')->on('projects');
			$table->string('name', 50);
			$table->text('description')->nullable();
			$table->timestamps();
			$table->timestamp('due_date')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('tasks', function (Blueprint $table) {
			$table->dropForeign('tasks_project_id_foreign');
		});
    }
}
