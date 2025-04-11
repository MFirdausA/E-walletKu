<?php

namespace Database\Seeders;

use App\Models\tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['id' => 1 , 'name' => 'Daily' , 'user_id' => null],
            ['id' => 2 , 'name' => 'Unexpected' , 'user_id' => null],
            ['id' => 3 , 'name' => 'Urgent' , 'user_id' => null],
            ['id' => 4 , 'name' => 'Priority' , 'user_id' => null],
            ['id' => 5 , 'name' => 'Seconds' , 'user_id' => null],
            ['id' => 6 , 'name' => 'tertiary' , 'user_id' => null],
        ];

        tag::insert($tags);
    }
}
