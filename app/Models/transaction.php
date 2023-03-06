<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        "transaction_id",
        "transaction_number",
        "created_at",
        "user_id",
        "name",
        "shipping_name",
        "shipping_street",
        "shipping_address",
        "shipping_phone",
        "qty",
        "frame_name",
        "frame_price",
        "lens_type",
        "lens_price",
        "subtotal",
        "total",
        "delivery_fee",
        "grand_total",
        "payment_status",
        "delivery_status",
    ];
}

// kalau begitu, buatkan model, resource, request Transaction_detail, kemudian ubah model transaction di atas agar memiliki relationship