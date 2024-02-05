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
        Schema::create('doc_upms', function (Blueprint $table) {
            $table->id();
            $table->string('dm_number');
            $table->string('subject');
            $table->string('user');
            $table->date('tgldoc');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            // $table->string('file');
            $table->string('attachment_path')->default('')->nullable();
            $table->timestamps();
        });

        // Schema::table('doc_upms', function (Blueprint $table) {
        //     $table->unsignedBigInteger('doc_file_id')->nullable();
        //     $table->foreign('doc_file_id')->references('id')->on('doc_files')->onDelete('set null');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('doc_upms', function (Blueprint $table) {
        //     $table->dropForeign(['doc_file_id']);
        //     $table->dropColumn('doc_file_id');
        // });
        
        Schema::dropIfExists('doc_upms');
    }
};
