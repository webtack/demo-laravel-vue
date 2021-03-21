<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    if (Schema::hasTable('tags') && Schema::hasTable('news')) {
		
		    Schema::create('news_tags', function (Blueprint $table) {
			    $table->bigIncrements('id');
			    $table->uuid('news_uuid')->index();
			    $table->uuid('tag_uuid')->index();			    
			    $table->unique(['news_uuid', 'tag_uuid']);
		    });
		    
		    Schema::table('news_tags', function($table) {
			    $table->foreign('tag_uuid')
				    ->references('uuid')
				    ->on('tags')
				    ->onDelete('cascade');
			
			    $table->foreign('news_uuid')
				    ->references('uuid')
				    ->on('news')
				    ->onDelete('cascade');
		    });
	    }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_tags');
    }
}
