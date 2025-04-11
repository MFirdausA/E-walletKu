<?php

namespace Database\Seeders;

use App\Models\wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wallets = [
            ['id' => 1, 'name' => 'Bank', 'user_id' => null, 'cover' => 'covers/icon'],
            ['id' => 2, 'name' => 'Cash', 'user_id' => null, 'cover' => 'covers/icon'],
        ];

        wallet::insert($wallets);
    }
}
