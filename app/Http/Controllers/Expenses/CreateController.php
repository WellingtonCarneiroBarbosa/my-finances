<?php

namespace App\Http\Controllers\Expenses;

use App\Entities\Recurring;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $categories = $request->currentUser()
                        ->currentWorkspace
                        ->expenseCategories
                        ->toSelect()
                        ->toArray();

        $recurringPeriods = Recurring::toSelect()
                                ->toArray();

        return Inertia::render('Dashboard/Expenses/Create', [
            'categories'       => $categories,
            'recurringPeriods' => $recurringPeriods,
        ]);
    }
}
