<?php

namespace App\Http\Controllers\Expenses\Categories;

use App\Http\Controllers\Controller;
use App\Models\Expenses\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        return Inertia::render('Dashboard/Expenses/Categories/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'color'       => ['required', 'string', 'max:7'],
        ]);

        $category = new Category();

        $category->forceFill([
            'name'        => $request->name,
            'description' => $request->description,
            'color'       => $request->color,
        ]);

        $category->workspace()->associate($request->currentUser()->currentWorkspace);

        $category->save();

        return redirect()->route('dashboard.expenses.categories.index');
    }
}
