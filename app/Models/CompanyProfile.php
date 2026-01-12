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

    /**
     * Check if current time is within operating hours
     */
    public function getIsWithinOperatingHoursAttribute()
    {
        if ($this->open_time && $this->close_time) {
            $now = \Carbon\Carbon::now();
            $openTime = \Carbon\Carbon::createFromFormat('H:i', $this->open_time->format('H:i'));
            $closeTime = \Carbon\Carbon::createFromFormat('H:i', $this->close_time->format('H:i'));
            $currentTime = \Carbon\Carbon::createFromFormat('H:i', $now->format('H:i'));
            
            return $currentTime->between($openTime, $closeTime);
        }
        return true;
    }

    /**
     * Get store status
     * - Returns true if store is open (within operating hours AND not manually closed)
     * - Returns false if store is closed (outside operating hours OR manually closed)
     */
    public function getStoreStatusAttribute()
    {
        // If manually closed (is_open = false), store is closed
        if (!$this->is_open) {
            return false;
        }

        // Otherwise, follow operating hours
        return $this->is_within_operating_hours;
    }

    /**
     * Get store status text for display
     * - 'open' = Buka (dalam jam operasional dan tidak ditutup manual)
     * - 'closed_manual' = Tutup Sementara (ditutup manual oleh admin)
     * - 'closed_hours' = Di Luar Jam Operasional (di luar jam operasional)
     */
    public function getStoreStatusTextAttribute()
    {
        if (!$this->is_open) {
            return 'closed_manual';
        }

        if (!$this->is_within_operating_hours) {
            return 'closed_hours';
        }

        return 'open';
    }
}
