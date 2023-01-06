<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'time_from', 'time_to', 'capacity', 'is_available'];

    //Define Query Scope
    public function scopeLatestSchedule(Builder $query)
    {
        return $query->orderBy('date', 'asc');
    }

    // Change the Format
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = (new Carbon($value))->format('Y/m/d');
    }

    public function getDateAttribute($value)
    {
        return $this->attributes['date'] = (new Carbon($value))->format('Y/m/d');
    }

    public function setTimeFromAttribute($value)
    {
        $this->attributes['time_from'] = (new Carbon($value))->format('H:i');
    }

    public function getTimeFromAttribute($value)
    {
        return $this->attributes['time_from'] = (new Carbon($value))->format('H:i');
    }

    public function setTimeToAttribute($value)
    {
        $this->attributes['time_to'] = (new Carbon($value))->format('H:i');
    }

    public function getTimeToAttribute($value)
    {
        return $this->attributes['time_to'] = (new Carbon($value))->format('H:i');
    }

    //Relations
    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    //Model Events
    public static function boot()
    {
        parent::boot();
        static::deleting(function (Schedule $schedule) {
            $schedule->appointment()->delete();
        });
    }
}
