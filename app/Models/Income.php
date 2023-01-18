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
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $amount
 * @property string $date
 * @property int $is_recurring
 * @property int $recurring_interval
 * @property int $team_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereIsRecurring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereRecurringInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUpdatedAt($value)
 */
class Income extends Model
{
    use HasFactory;
}
