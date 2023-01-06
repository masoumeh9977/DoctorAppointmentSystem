<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = ['symptom_image'];

    //Register Global Scope
    protected static function booted()
    {
        static::addGlobalScope(new LatestScope);
    }

    // Change the Format
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
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
