<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class WeddingSettings extends Model
{

    protected $fillable = [
        'bride_name',
        'groom_name',
        'hashtag',
        'wedding_date',
        'theme_color'
    ];

    protected $casts = [
        'wedding_date' => 'date'
    ];

    public static function current()
    {
        return static::first() ?? static::create([]);
    }

    public function getCoupleNameAttribute(): string
    {
        return $this->bride_name . ' & ' . $this->groom_name;
    }

    public function getDaysUntilWeddingAttribute(): float|int
    {
        if (!$this->wedding_date) {
            return 0;
        }

        $now = Carbon::now();
        $weddingDate = Carbon::parse($this->wedding_date);

        return $now->diffInDays($weddingDate, false);
    }

    public function getIsWeddingTodayAttribute(): bool
    {
        return $this->wedding_date && Carbon::now()->isSameDay($this->wedding_date);
    }

    public function getIsWeddingPastAttribute(): bool
    {
        return $this->wedding_date && Carbon::now()->isAfter($this->wedding_date);
    }

    public function getTimeUntilWeddingAttribute(): ?array
    {
        if (!$this->wedding_date) {
            return null;
        }

        $now = Carbon::now();
        $weddingDate = Carbon::parse($this->wedding_date)->startOfDay();

        if ($now->isAfter($weddingDate)) {
            return null;
        }

        $diff = $now->diff($weddingDate);

        return [
            'days' => $diff->days,
            'hours' => $diff->h,
            'minutes' => $diff->i,
            'seconds' => $diff->s
        ];
    }
}
