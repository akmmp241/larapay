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
        Schema::create('payment_links', function (Blueprint $table) {
            $table->string("id")->primary()->unique();
            $table->string("xendit_pr_id")->unique();
            $table->bigInteger("amount");
            $table->string("status");
            $table->text("description")->nullable();
            $table->dateTime("expire_date")->nullable();
            $table->dateTime("paid_at")->nullable();
            $table->string("success_payment_redirect");
            $table->string("channel_code");
            $table->string("payment_method");
            $table->string("failure_code")->nullable();
            $table->string("payer_email")->nullable();
            $table->string("payer_name")->nullable();
            $table->string("payer_mobile_num")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_links');
    }
};
