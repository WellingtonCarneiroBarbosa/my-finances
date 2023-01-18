<?php

namespace App\Entities;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Recurring
{
    public const RECURRING_INTERVALS = [
        'daily'       => 1,
        'weekly'      => 7,
        'monthly'     => 30,
        'trimesterly' => 90,
        'half-yearly' => 180,
        'yearly'      => 365,
        'bi-yearly'   => 730,
    ];

    public static function toSelect(): Collection
    {
        return self::toCollection()
            ->map(function ($value, $key) {
                return [
                    'label' => Str::ucfirst($key),
                    'value' => $key,
                ];
            });
    }

    public static function toCollection(): Collection
    {
        return collect(self::RECURRING_INTERVALS);
    }
}
