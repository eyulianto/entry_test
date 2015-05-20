<?php

use App\Model\Website;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(Website::TABLENAME, function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 50);
			$table->string('url', 125);
			$table->string('rss_url', 125)->unique();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop(Website::TABLENAME);
	}

}
