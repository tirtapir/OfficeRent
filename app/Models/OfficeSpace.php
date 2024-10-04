<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illmuinate\Database\Eloquent\HasMany;
use Illmuinate\Database\Eloquent\BelongsTo;
use Illmuinate\Database\Eloquent\SoftDeletes;
use Illmuniate\Support\Str;

class OfficeSpace extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'thumbnail',
        'is_opened',
        'is_full_booked',
        'price',
        'duration',
        'about',
        'slug',
        'address',
        'city_id',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
 
    public function photos(): HasMany
    {
        return $this->hasMany(OfficeSpacePhoto::class);
    }

    public function benefits(): HasMany
    {
        return $this->hasMany(OfficeSpaceBenefit::class);
    }
}
