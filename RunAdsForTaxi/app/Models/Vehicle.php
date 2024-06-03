<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicle';
    protected $fillable = [ 'vehicle_num',
                            'company_id',
                            'tablet_id',
                            'sim_number',
                            'app_id',];
}
