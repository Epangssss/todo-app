<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTasksAddDatetimeColumns extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dateTime('start_date')->change(); // Mengubah kolom start_date menjadi datetime
            $table->dateTime('deadline')->change(); // Mengubah kolom deadline menjadi datetime
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->date('start_date')->change(); // Kembali ke date jika rollback
            $table->date('deadline')->change(); // Kembali ke date jika rollback
        });
    }
}
