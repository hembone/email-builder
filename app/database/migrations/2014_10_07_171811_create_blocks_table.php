<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blocks', function($table)
		{
		    $table->increments('id');
		    $table->integer('category_id');
		    $table->integer('brand_id');
		    $table->string('name');
		    $table->text('css');
		    $table->text('code');
		    $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('blocks');
	}

}
