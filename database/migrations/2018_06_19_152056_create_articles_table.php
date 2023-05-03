<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @todo user relation (author)
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 150);
            $table->string('slug', 150);
            $table->text('intro')->nullable();
            $table->text('content')->nullable();
            $table->dateTime('publish_start')->nullable();
            $table->dateTime('publish_end')->nullable();
            $table->integer('hits')->default(0);
            $table->string('view', 255)->nullable();
            $table->boolean('active')->default(true);
            $table->text('parameters')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
