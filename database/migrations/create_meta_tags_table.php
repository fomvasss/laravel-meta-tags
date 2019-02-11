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

            // Meta-tags
            $table->string('title')->nullable();
            $table->string('keywords')->nullable();
            $table->text('description')->nullable();
            
            // SEO-fields
            $table->string('h1')->nullable();
            $table->text('seo_text')->nullable();
            $table->string('canonical')->nullable();
            $table->string('robots', 50)->nullable();

            // Fields for build XML site-map
            $table->string('changefreq', 10)->nullable();
            $table->string('priority', 10)->nullable();

            // OG-tags
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

            //for XML site-map "lastmod"
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
        Schema::dropIfExists('meta_tags');
    }
}
