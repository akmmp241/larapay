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
        Schema::create('settings', function (Blueprint $table) {
            $table->string("xendit_mode", 15)->nullable()->default(null);
            $table->string("xendit_api_key", 200)->nullable()->default(null);
            $table->string("xendit_webhook_token", 200)->nullable()->default(null);
            $table->json("default_payment_method")->nullable()->default(null);
            $table->string("payment_success_redirect_url", 200)->nullable()->default(null);
            $table->string("payment_failed_redirect_url", 200)->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
