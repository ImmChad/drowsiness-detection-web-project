<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyVideo extends Model
{
    use HasFactory;
    protected $table = "company_video";
    protected $fillable = array('id', 'company_id', 'change_time','video_id','is_active');
}
