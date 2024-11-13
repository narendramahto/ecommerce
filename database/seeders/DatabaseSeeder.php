<?php

namespace Database\Seeders;

use App\Models\CouponCode;
use App\Models\CouponRule;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();

        // // User::factory()->create([
        // //     'name' => 'Test User',
        // //     'email' => 'test@example.com',
        // // ]);

        // $this->call(ProductSeeder::class);
        CouponCode::factory()
            ->count(10)
            ->has(CouponRule::factory()->count(rand(1, 3)), 'couponRules') // Create related rules
            ->create();
    }
}
