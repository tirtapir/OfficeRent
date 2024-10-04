<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illmuinate\Database\Eloquent\SoftDeletes;


class OfficeSpacePhoto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillabel = [
        'photo',
        'office_space_id',
    ];
}
