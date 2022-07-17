<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stopping_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()
                ->constrained('projects', 'id')
                ->nullOnDelete();
            $table->foreignId('association_id')->nullable()
                ->constrained('associations', 'id')
                ->nullOnDelete();
            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending');
            $table->text("reason_stopping");
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
        Schema::dropIfExists('stopping_projects');
    }
};
