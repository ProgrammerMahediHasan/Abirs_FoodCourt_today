<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class RestaurantTableController extends Controller
{
    public function index()
    {
        if (!Schema::hasTable('restaurant_tables')) {
            $tables = collect([]);
            return view('pages.erp.tables.index', ['tables' => new \Illuminate\Pagination\LengthAwarePaginator($tables, 0, 10)]);
        }
        $tables = RestaurantTable::with('restaurant')->orderBy('restaurant_id')->orderBy('name')->paginate(10);
        return view('pages.erp.tables.index', compact('tables'));
    }

    public function create()
    {
        if (!Schema::hasTable('restaurants')) {
            $restaurants = collect([]);
            return view('pages.erp.tables.create', compact('restaurants'));
        }
        $restaurants = Restaurant::orderBy('name')->get();
        return view('pages.erp.tables.create', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,booked,occupied',
        ]);

        RestaurantTable::create($request->only('restaurant_id', 'name', 'capacity', 'status'));

        return redirect()->route('tables.index')->with('success', 'Table created successfully.');
    }

    public function edit(RestaurantTable $table)
    {
        $restaurants = Restaurant::orderBy('name')->get();
        return view('pages.erp.tables.edit', compact('table', 'restaurants'));
    }

    public function update(Request $request, RestaurantTable $table)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,booked,occupied',
        ]);

        $table->update($request->only('restaurant_id', 'name', 'capacity', 'status'));

        return redirect()->route('tables.index')->with('success', 'Table updated successfully.');
    }

    public function destroy(RestaurantTable $table)
    {
        $table->delete();
        return redirect()->route('tables.index')->with('success', 'Table deleted successfully.');
    }
}
