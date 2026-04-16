<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreakRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('break_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('break_id')->constrained()->cascadeOnDelete();
            $table->datetime('request_break_start')->nullable();
            $table->datetime('request_break_end')->nullable();
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
        Schema::dropIfExists('break_requests');
    }
}
