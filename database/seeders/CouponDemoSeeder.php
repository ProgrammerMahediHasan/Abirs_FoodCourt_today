<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CouponDemoSeeder extends Seeder
{
    public function run(): void
    {
        $exists = DB::table('coupons')->where('code', 'SAVE10')->exists();
        if (! $exists) {
            DB::table('coupons')->insert([
                'code' => 'SAVE10',
                'type' => 'percent',
                'value' => 10,
                'active' => true,
                'starts_at' => Carbon::now(),
                'expires_at' => Carbon::now()->addDays(30),
                'max_uses' => 100,
                'used' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
