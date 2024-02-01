<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Inbound',
            'Outbound',
        ];

        // insert data to database
        Type::insert(array_map(function ($type) {
            return [
                'name' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $types));
    }
}
