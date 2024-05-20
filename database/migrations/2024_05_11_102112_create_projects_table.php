<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('project_name');
            $table->date('start_date');
            $table->date('dead_line');
            $table->bigInteger('project_cost')->nullable();
            $table->bigInteger('project_budget')->nullable();
            $table->foreignId('client_id')->references('id')->on('clients')->cascadeOnDelete();
            $table->string('project_summary');
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
