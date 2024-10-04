<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illmuinate\Database\Eloquet\SoftDeletes;

class OfficeSpaceBenefit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'office_space_id',
    ];
}
