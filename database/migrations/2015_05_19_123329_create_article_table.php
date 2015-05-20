<?php

use App\Model\Article;
use App\Model\Website;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(Article::TABLENAME, function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 200);
			$table->string('url', 150)->unique();
			$table->string('thumbnail_url', 150);
			$table->text('summary');
			$table->longText('content');
			$table->dateTime('publish_date');
			$table->integer('website_id')->unsigned();
			$table->foreign('website_id')
					->references('id')
					->on(Website::TABLENAME)
					->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop(Article::TABLENAME);
	}

}
