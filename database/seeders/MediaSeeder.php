<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $media_official_channels = [
            'WA Center',
            'Call',
            'Website',
            'Email',
            'Whatsapp Blast',
            'Referal',
            'OOH',
        ];

        $media_walk_ins = [
            'Branch Badung',
            'Branch Denpasar',
            'Branch Malang',
            'Branch Balikpapan',
            'Branch Samarinda',
        ];

        $media_marketing_channels = [
            'Open Booth',
            'Digital Platform',
        ];

        // insert data to database
        Media::insert(array_map(function ($media) {
            return [
                'name' => $media,
                'channel_id' => 1, // 'Official Channels
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $media_official_channels));

        Media::insert(array_map(function ($media) {
            return [
                'name' => $media,
                'channel_id' => 2, // 'Walk-ins
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $media_walk_ins));

        Media::insert(array_map(function ($media) {
            return [
                'name' => $media,
                'channel_id' => 3, // 'Marketing Channels
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $media_marketing_channels));
    }
}
