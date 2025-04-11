<?php

namespace Database\Seeders;

use App\Models\status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['id' => 1, 'name' => 'Upcoming'],
            ['id' => 2, 'name' => 'Overdue'],
            ['id' => 3, 'name' => 'Complete'],
        ];

        status::insert($statuses);
    }
}
