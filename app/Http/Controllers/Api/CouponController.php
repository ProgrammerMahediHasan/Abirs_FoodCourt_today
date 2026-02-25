<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function validateCode(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:50'],
            'subtotal' => ['nullable', 'numeric', 'min:0'],
        ]);

        $code = strtoupper(trim($data['code']));
        $subtotal = (float) ($data['subtotal'] ?? 0);

        $coupon = DB::table('coupons')->where('code', $code)->first();

        if (! $coupon || ! $coupon->active) {
            return response()->json(['message' => 'Invalid or inactive coupon code'], 422);
        }

        $now = Carbon::now();
        $start = $coupon->starts_at ? Carbon::parse($coupon->starts_at) : null;
        $end = $coupon->expires_at ? Carbon::parse($coupon->expires_at) : null;
        if (($start && $now->lt($start))
            || ($end && $now->gt($end))) {
            return response()->json(['message' => 'This coupon is not available at this time'], 422);
        }

        if ($coupon->max_uses && $coupon->used >= $coupon->max_uses) {
            return response()->json(['message' => 'This coupon has reached its usage limit'], 422);
        }

        $discount = 0.0;
        if ($coupon->type === 'percent') {
            $discount = round(($subtotal * (float) $coupon->value) / 100, 2);
        } else {
            $discount = round((float) $coupon->value, 2);
        }

        if ($discount > $subtotal) {
            $discount = $subtotal;
        }

        return response()->json([
            'code' => $code,
            'type' => $coupon->type,
            'value' => (float) $coupon->value,
            'discount' => $discount,
        ]);
    }
}
