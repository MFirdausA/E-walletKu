<?php

namespace Database\Seeders;

use App\Models\loanType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loanTypes = [
            ['id' => 1, 'name' => 'Borrow money'],
            ['id' => 2, 'name' => 'Lend money'],
        ];

        loanType::insert($loanTypes);
    }
}
