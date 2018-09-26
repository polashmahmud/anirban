<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->double('start_amount',8,2);
            $table->double('end_amount',8,2);
            $table->boolean('type')->default(false)->comment('0=lone,1=saving,2=investment');
            $table->boolean('period')->default(false)->comment('0=day,1=week,2=month');
            $table->integer('installment');
            $table->boolean('status')->default(false)->comment('0=suspend,1=active');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
