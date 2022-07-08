<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable()->default(null);
            $table->string('title');
            $table->string('category')->nullable()->default(null);
            $table->string('link')->nullable();
            $table->string('type')->nullable(); //relative,external
            $table->string('target')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('show_icon')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('admin')->default(false);
            $table->boolean('hide_link')->default(false);

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
        Schema::dropIfExists('menus');
    }
}
