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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('doctor_id')->default('1');
            $table->foreignId('service_id');
            $table->text('disease')->nullable();
            $table->text('complaint');
            $table->timestamp('control')->nullable();
            $table->enum('status', ['menunggu konfirmasi', 'menunggu antrian', 'ditangani', 'menunggu pembayaran', 'selesai', 'dibatalkan', 'ditolak'])->default('menunggu konfirmasi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatments');
    }
};
