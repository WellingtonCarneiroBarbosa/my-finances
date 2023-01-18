<?php

namespace App\Http\Controllers\Incomes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        return Inertia::render('Incomes/Create');
    }

    public function store()
    {
        $data = $this->validate(request(), [
            'name'               => 'required|string',
            'description'        => 'required|string',
            'amount'             => 'required|integer',
            'date'               => 'required|date',
            'is_recurring'       => 'required|boolean',
            'recurring_interval' => 'required|integer',
        ]);

        $income = auth()->user()->incomes()->create($data);

        return redirect()->route('incomes.show', $income);
    }
}
