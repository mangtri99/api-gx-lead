<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $channels = [
            'Official Channels',
            'Walk-ins',
            'Marketing Channels',
        ];

        // insert data to database
        Channel::insert(array_map(function ($channel) {
            return [
                'name' => $channel,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $channels));
    }
}
