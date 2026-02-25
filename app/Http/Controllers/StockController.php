<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Menu;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('menu')->paginate(10);
        return view('pages.erp.stocks.index', compact('stocks'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('pages.erp.stocks.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id|unique:stocks,menu_id',
            'current_quantity' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
        ]);

        Stock::create($request->all());

        return redirect()->route('stocks.index')->with('success', 'Stock added successfully.');
    }

    public function edit(Stock $stock)
    {
        $menus = Menu::all();
        return view('pages.erp.stocks.edit', compact('stock', 'menus'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id|unique:stocks,menu_id,' . $stock->id,
            'current_quantity' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
        ]);

        $stock->update($request->all());

        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully.');
    }

    public function restock(Request $request, Stock $stock)
    {
        $data = $request->validate([
            'quantity' => ['required', 'numeric', 'min:0.01'],
            'unit' => ['required', 'string', 'max:50'],
            'reference' => ['nullable', 'string', 'max:100'],
        ]);

        if ($stock->unit && $data['unit'] && strtolower($stock->unit) !== strtolower($data['unit'])) {
            return redirect()->back()->withErrors('Unit mismatch for this stock item.');
        }

        $stock->current_quantity = ($stock->current_quantity ?? 0) + (float) $data['quantity'];
        $stock->unit = $stock->unit ?: $data['unit'];
        $stock->save();

        return redirect()->route('stocks.index')->with('success', 'Stock increased successfully.');
    }
}
