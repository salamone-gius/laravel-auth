<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            // lo slug è la parte di uri che identifica il post (ovviamente univoca). Conviene che non ci siano numeri o id, ma che sia uguale o simile al titolo del post per rendere l'url più 'parlante' e indicizzabile dai motori di ricerca (SEO friendly)
            $table->string('slug')->unique();
            $table->text('content');
            // flag che pubblica o meno un post. Di default non sarà pubblicato
            $table->boolean('published')->default(false);
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
        Schema::dropIfExists('posts');
    }
}
