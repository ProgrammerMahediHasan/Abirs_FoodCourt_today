<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CouponAdminController extends Controller
{
    public function index()
    {
        $coupons = DB::table('coupons')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('pages.erp.coupons.index', compact('coupons'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:coupons,code'],
            'type' => ['required', 'in:percent,amount'],
            'value' => ['required', 'numeric', 'min:0'],
            'starts_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'max_uses' => ['nullable', 'integer', 'min:1'],
        ]);

        DB::table('coupons')->insert([
            'code' => strtoupper(trim($data['code'])),
            'type' => $data['type'],
            'value' => $data['value'],
            'active' => true,
            'starts_at' => $data['starts_at'] ? Carbon::parse($data['starts_at']) : null,
            'expires_at' => $data['expires_at'] ? Carbon::parse($data['expires_at']) : null,
            'max_uses' => $data['max_uses'] ?? null,
            'used' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function update(Request $request, int $id)
    {
        $coupon = DB::table('coupons')->where('id', $id)->first();
        if (! $coupon) {
            return redirect()->route('coupons.index')->withErrors('Coupon not found.');
        }

        $data = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:coupons,code,'.$id],
            'type' => ['required', 'in:percent,amount'],
            'value' => ['required', 'numeric', 'min:0'],
            'starts_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'max_uses' => ['nullable', 'integer', 'min:1'],
            'active' => ['nullable', 'boolean'],
        ]);

        DB::table('coupons')
            ->where('id', $id)
            ->update([
                'code' => strtoupper(trim($data['code'])),
                'type' => $data['type'],
                'value' => $data['value'],
                'starts_at' => $data['starts_at'] ? Carbon::parse($data['starts_at']) : null,
                'expires_at' => $data['expires_at'] ? Carbon::parse($data['expires_at']) : null,
                'max_uses' => $data['max_uses'] ?? null,
                'active' => $request->boolean('active'),
                'updated_at' => Carbon::now(),
            ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(int $id)
    {
        DB::table('coupons')->where('id', $id)->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted.');
    }
}
