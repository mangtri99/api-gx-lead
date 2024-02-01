<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Consideration',
            'Scheduled',
            'Junk/Trash',
            'FCB - Future Call Back',
            'Qualified',
            'NI - Not Interested',
            'Out Coverage',
            'Not Response',
            'Pending',
            'Cancel'
        ];

        // insert data to database
        Status::insert(array_map(function ($status) {
            return [
                'name' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $statuses));
    }
}
