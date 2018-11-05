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
            // url path
            $table->string('path')->nullable();

            // node, term,...
            $table->integer('metatagable_id')->nullable();
            $table->string('metatagable_type')->nullable();
            
            // fields - set in config/meta-tags.php
            $fields = config('meta-tags.available', []);
            foreach ($fields as $fieldName => $option) {
                $table->{$option['form_type'] ?? 'string'}($fieldName)->nullable();
            }
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
