<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameColor extends Model
{
    protected $table = 'frame_colors';
    protected $fillable = [
        "frame_id",
        "color",
    ];
}
?>