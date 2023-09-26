<?php

namespace Database\Seeders;

use App\Transaction as AppTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            factory(AppTransaction::class)->create([
                'amount' => fake()->randomElement([10000, 5000, 50000, 100000, 150000, 1000000, 90000]),
                'in_out' => fake()->randomElement([0, 1]),
                'category_id' => fake()->numberBetween(1, 8),
                'date' => fake()->dateTimeBetween('-20 days')->format("Y-m-d")
            ]);
        }
    }
}
