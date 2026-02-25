<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class ProductController extends Controller
{
    public function index()
    {
        $menus = Menu::with(['category', 'stock'])
            ->where('status', true)
            ->orderBy('name')
            ->get();

        $data = $menus->map(function (Menu $menu) {
            $availability = 'unavailable';
            $qty = null;
            if ($menu->stock) {
                $qty = (int) ($menu->stock->current_quantity ?? 0);
                $availability = $qty > 0 ? 'available' : 'out_of_stock';
            }

            return [
                'id' => $menu->id,
                'name' => $menu->name,
                'description' => $menu->description,
                'price' => $menu->price,
                'category' => $menu->category->name ?? null,
                'category_name' => $menu->category->name ?? null,
                'image_url' => $menu->image ? asset('storage/'.$menu->image) : null,
                'availability' => $availability,
                'stock_quantity' => $qty,
            ];
        });

        return response()->json($data);
    }
}
