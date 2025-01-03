<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $total = 20;

        for ($i = 0; $i < $total; $i++)
            Transaction::factory()
                ->for(Category::inRandomOrder()->first())
                ->create();
    }
}
