<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Income
 *
 * @method static \Database\Factories\IncomeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Income query()
 * @mixin \Eloquent
 */
class Income extends Model
{
    use HasFactory;

    public const RECURRING_INTERVALS = [
        'daily'       => 1,
        'weekly'      => 7,
        'monthly'     => 30,
        'trimesterly' => 90,
        'half-yearly' => 180,
        'yearly'      => 365,
        'bi-yearly'   => 730,
    ];
}
