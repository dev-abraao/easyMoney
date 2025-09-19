<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ExpenseTypes;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Food', 'Transport', 'Entertainment', 'Investments', 'Bills', 'Shopping', 'Other'];
        foreach ($types as $type) {
            ExpenseTypes::create(['name' => $type]);
        }
    }
}
