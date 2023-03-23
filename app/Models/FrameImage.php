<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameImage extends Model
{
    use HasFactory;
    // protected $table = 'frame_images';

    protected $primaryKey = 'frame_id';
    protected $fillable = [
        "frame_id",
        "pict_path"
    ];
}