<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $table = "video";
    protected $fillable = [
                                'id',
                        'video_path',
                        'video_name',
                        'video_description',
                        'video_length',
                        'video_thumbnail',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        ];
}
