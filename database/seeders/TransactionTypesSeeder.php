<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactionTypes = [
            ['id' => 1, 'name' => 'Income', 'cover' => 'covers/icon'],
            ['id' => 4, 'name' => 'Expense', 'cover' => 'covers/icon'],
            ['id' => 5, 'name' => 'Transfer', 'cover' => 'covers/icon'],
            ['id' => 6, 'name' => 'Planned', 'cover' => 'covers/icon'],
        ];

        TransactionType::insert($transactionTypes);
    }
}
