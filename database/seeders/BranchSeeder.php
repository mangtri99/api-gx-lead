<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            'GlobalXtreme Bali',
            'GlobalXtreme Malang',
            'GlobalXtreme Jakarta',
            'GlobalXtreme Balikpapan',
            'GlobalXtreme Samarinda',
        ];

        // insert data to database
        Branch::insert(array_map(function ($branch) {
            return [
                'name' => $branch,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $branches));
    }
}
