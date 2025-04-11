<?php

namespace Database\Seeders;

use App\Models\repeatType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RepeatTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $repeatTypes = [
            ['id' => 1, 'name' => 'Daily'],
            ['id' => 2, 'name' => 'Monthly'],
            ['id' => 3, 'name' => 'Yearly'],
            ['id' => 4, 'name' => 'Weekly'],
        ];

        repeatType::insert($repeatTypes);
    }
}
