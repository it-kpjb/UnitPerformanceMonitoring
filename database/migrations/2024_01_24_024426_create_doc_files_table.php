<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doc_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doc_upm_id');
            $table->string('attachment_path');
            $table->timestamps();

            $table->foreign('doc_upm_id')->references('id')->on('doc_upms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('doc_files', function (Blueprint $table) {
        //     // Perbaikan: Menghapus kunci asing terlebih dahulu sebelum menghapus tabel
        //     $table->dropForeign(['doc_upm_id']);
        // });
        Schema::dropIfExists('doc_files');
    }
};
