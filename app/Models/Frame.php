<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;
    protected $table = 'frames';

    protected $primaryKey = 'frame_id';

    protected $fillable = [
        "frame_id",
        "name",
        "stock",
        "price",
        "material",
        "shape",
        "description",
        "pictPath",
        "rating",
    ];
}