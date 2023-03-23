<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        "name",
        "email",
        "phone",
        "password",
        "birth",
        "gender",
        "avatar_path",
        "email_verified_at",
        "phone_verified_at",
        "is_banned",
        "is_inactive",
    ];

}