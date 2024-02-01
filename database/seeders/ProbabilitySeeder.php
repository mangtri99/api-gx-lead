<?php

namespace Database\Seeders;

use App\Models\Probability;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProbabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $probabilities = [
            'Pending',
            'Converted',
            'Cancel',
        ];

        // insert data to database
        Probability::insert(array_map(function ($probability) {
            return [
                'name' => $probability,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $probabilities));
    }
}
