<?php

namespace App\Http\Controllers\Incomes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $recurringPeriods = \App\Models\Income::RECURRING_INTERVALS;

        $periods = collect($recurringPeriods)->map(function ($value, $key) {
            return [
                'label'    => Str::ucfirst($key),
                'value'    => $key,
            ];
        });

        return Inertia::render('Dashboard/Incomes/Create', [
            'recurringPeriods' => $periods,
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
