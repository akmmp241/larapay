<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLink extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "id",
        "xendit_pr_id",
        "amount",
        "status",
        "description",
        "expire_date",
        "paid_at",
        "success_payment_redirect",
        "channel_code",
        "payment_method",
        "failure_code",
        "payer_name",
        "payer_email",
        "payer_mobile_num",
    ];

    protected $casts = [
        "expire_date" => "datetime",
        "paid_at" => "datetime",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

}
