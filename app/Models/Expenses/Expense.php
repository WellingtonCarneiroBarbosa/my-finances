<?php

namespace App\Models\Expenses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Expenses\Expense
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense query()
 * @mixin \Eloquent
 * @property-read \App\Models\Expenses\Category|null $category
 */
class Expense extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
