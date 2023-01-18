<?php

namespace App\Http\Controllers\Incomes;

use App\Entities\Recurring;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        return Inertia::render('Dashboard/Incomes/Create', [
            'recurringPeriods' => Recurring::toSelect(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'name'               => 'required|string',
            'description'        => 'required|string',
            'amount'             => 'required|integer',
            'date'               => 'required|date',
            'is_recurring'       => 'required|boolean',
            'recurring_interval' => 'required|integer',
        ]);

        $income = $request->currentUser()
                    ->currentTeam()
                    ->incomes()
                    ->create($data);

        return redirect()->route('dashboard.incomes.show', $income);
    }
}
