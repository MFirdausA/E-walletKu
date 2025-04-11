<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Food & Groceries', 'cover' => 'covers/icon'],
            ['name' => 'Transportation', 'cover' => 'covers/icon'],
            ['name' => 'Insurance', 'cover' => 'covers/icon'],
            ['name' => 'Mobile & Data', 'cover' => 'covers/icon'],
            ['name' => 'Utilities', 'cover' => 'covers/icon'],
            ['name' => 'Entertainment', 'cover' => 'covers/icon'],
            ['name' => 'Travel & Leisure', 'cover' => 'covers/icon'],
            ['name' => 'Subscriptions', 'cover' => 'covers/icon'],
            ['name' => 'Health & Fitness', 'cover' => 'covers/icon'],
            ['name' => 'Education & Learning', 'cover' => 'covers/icon'],
            ['name' => 'Investment', 'cover' => 'covers/icon'],
            ['name' => 'Loan', 'cover' => 'covers/icon'],
            ['name' => 'Salary', 'cover' => 'covers/icon'],
            ['name' => 'Saving', 'cover' => 'covers/icon'],
            ['name' => 'Gifts', 'cover' => 'covers/icon'],
            ['name' => 'Freelance', 'cover' => 'covers/icon'],
            ['name' => 'Transfer to Savings', 'cover' => 'covers/icon'],
            ['name' => 'Transfer from Bank', 'cover' => 'covers/icon'],
            ['name' => 'Withdraw to Bank', 'cover' => 'covers/icon'],
        ];
        
        Category::insert($categories);
    }
}
