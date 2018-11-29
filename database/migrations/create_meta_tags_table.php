<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_tags', function (Blueprint $table) {
            $table->increments('id');

            // url path - without domain
            $table->string('path')->nullable();

            // metatagable: node, term,...
            $table->integer('metatagable_id')->nullable();
            $table->string('metatagable_type')->nullable();

            // it is not meta-tag!
            $table->string('h1')->nullable();

            // default meta-tags
            $table->string('title')->nullable();
            $table->string('keywords')->nullable();
            $table->text('description')->nullable();
            
            //$table->string('robots')->nullable();
            //$table->string('canonical')->nullable();

            //$table->string('og_title')->nullable();
            //$table->text('og_description')->nullable();
            //$table->string('og_type')->nullable();
            //$table->string('og_image')->nullable();
            //$table->string('og_url')->nullable();
            //$table->string('og_audio')->nullable();
            //$table->string('og_determiner')->nullable();
            //$table->string('og_locale')->nullable();
            //$table->string('og_site_name')->nullable();
            //$table->string('og_video')->nullable();
            // ... OG`s from config/meta-tags.php `available`
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_tags');
    }
}
