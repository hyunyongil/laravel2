<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncreaseNameAndRenamePublicColumnOnProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('projects', function (Blueprint $table) {
			$table->string('name', 50)->change();
			$table->renameColumn('public', 'is_public');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('projects', function (Blueprint $table) {
			$table->dropColumn('label');
		});
    }
}
