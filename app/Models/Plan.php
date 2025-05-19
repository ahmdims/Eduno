<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    /**
     * Table associated with the model.
     *
     * @var string
     */
    protected $table = 'plans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'duration',
        'pricing_features',
    ];

    /**
     * Cast attributes to specific types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'float',
        'duration' => 'integer',
        'pricing_features' => 'array',
    ];

    public function getFormattedPriceAttribute()
    {
        return 'Rp. ' . number_format($this->price, 0, ',', '.');
    }

    public function getDurationTextAttribute()
    {
        $duration = $this->duration;

        if ($duration >= 365) {
            $years = floor($duration / 365);
            $remainingDays = $duration % 365;

            $text = $years . ' Year' . ($years > 1 ? 's' : '');

            if ($remainingDays >= 30) {
                $months = floor($remainingDays / 30);
                $text .= ' ' . $months . ' Month' . ($months > 1 ? 's' : '');
            }

            return $text;
        }

        if ($duration % 30 == 0) {
            $months = $duration / 30;
            return $months . ' Month' . ($months > 1 ? 's' : '');
        }

        return $duration . ' Day' . ($duration > 1 ? 's' : '');
    }
}