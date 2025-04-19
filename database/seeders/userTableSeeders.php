<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class userTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
			'name' => 'Superadmin',
			'email' => env('DEFAULT_EMAIL', 'admin1@admin.com'),
			'password' => Hash::make(env('DEFAULT_PASSWORD', 'Alphaaa1')),
            'profile' => 'img/software-engineer.png'
        ]);
    }
}
