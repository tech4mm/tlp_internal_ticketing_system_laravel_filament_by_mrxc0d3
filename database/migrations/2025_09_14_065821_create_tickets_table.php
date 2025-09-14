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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');

            // Status & priority
            $table->enum('status', ['open', 'in_progress', 'resolved', 'closed'])->default('open');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');

            // Reporter & assignee
            $table->foreignId('reported_by')->constrained('users');   // CS team
            $table->foreignId('assigned_to')->nullable()->constrained('users'); // IT team

            // 🔹 Client info
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->enum('client_env', [
                'windows',
                'mac',
                'linux',
                'iphone',
                'android',
                'other'
            ])->nullable();
            $table->string('client_browser')->nullable();
            $table->string('client_device_model')->nullable();

            // 🔹 Bug details
            $table->dateTime('bug_est_time')->nullable(); // hours/mins
            $table->json('attachments')->nullable();
            $table->json('meta')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
