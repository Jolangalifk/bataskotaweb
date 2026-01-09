<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
        'instagram',
        'whatsapp',
        'open_time',
        'close_time',
        'is_open',
    ];

    protected $casts = [
        'open_time' => 'datetime:H:i',
        'close_time' => 'datetime:H:i',
        'is_open' => 'boolean',
    ];

    public function getOperatingHoursAttribute()
    {
        if ($this->open_time && $this->close_time) {
            return $this->open_time->format('H:i') . ' - ' . $this->close_time->format('H:i');
        }
        return null;
    }

    public function getStoreStatusAttribute()
    {
        if (!$this->is_open) {
            return false;
        }

        if ($this->open_time && $this->close_time) {
            $now = \Carbon\Carbon::now();
            $openTime = \Carbon\Carbon::parse($this->open_time);
            $closeTime = \Carbon\Carbon::parse($this->close_time);
            return $now->between($openTime, $closeTime);
        }

        return $this->is_open;
    }
}
