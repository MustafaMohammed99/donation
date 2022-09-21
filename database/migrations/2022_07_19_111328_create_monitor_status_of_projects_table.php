<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitor_status_of_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')
                ->constrained('admins', 'id')
                ->cascadeOnDelete();
            $table->foreignId('project_id')
                ->constrained('projects', 'id')
                ->cascadeOnDelete();

//            pending   ------ accepted
//                      ------ declined
//            accepted  ------ completed_partial
//                      ------ failed
//            pending_stopping
//                      ------ completed_partial
//                      ------ declined_stopping
//            pending_failed
//                      ------ accepted_failed
//                      ------ declined_failed
            $table->enum('before_edit', ['pending', 'accepted', 'pending_stopping','pending_failed']);
            $table->enum('status', ['accepted', 'declined', 'failed', 'completed_partial', 'declined_stopping','accepted_failed','declined_failed']);
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
        Schema::dropIfExists('monitor_status_of_projects');
    }
};
