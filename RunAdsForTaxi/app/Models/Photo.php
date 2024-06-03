<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table = "photo";
    protected $fillable = [
                        'id',
                        'photo_path',
                        'photo_name',
                        'photo_description',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        ];
}
