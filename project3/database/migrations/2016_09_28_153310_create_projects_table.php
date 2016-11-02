<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('title');
            $table->text('description');
            $table->text('foto');
            $table->string('address');
            $table->string('email')->nullable();
            $table->string('telephoneNumber')->nullable();
            $table->double('lat', 15, 8);  
            $table->double('lng', 15, 8);
            $table->boolean('isPriority')->default(0);
            $table->boolean('isCompany')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('projects');
    }
}
