<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_to_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('article_id');
			$table->unsignedInteger('category_id');
			$table->nestedSet();

			$table->unique(['article_id', 'category_id']);
			
			$table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_to_categories');
    }
}
