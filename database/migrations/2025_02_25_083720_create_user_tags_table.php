<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('tag_id')->nullable();
            $table->text('qr_code')->nullable();
            $table->string('valuable_type')->nullable();
            $table->text('bag_description')->nullable();
            $table->string('display_name')->nullable();
            $table->string('bag_brand')->nullable();
            $table->text('tag_image')->nullable();
            $table->date('tag_active_date')->nullable();
            $table->enum('tag_status', ['active','deactive','fresh','Report Lost'])->default('fresh'); // Add status field

            // $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
            $table->softDeletes(); // Enable soft deletes
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_tags');
    }
};

