<?php

namespace Database\Seeders;

use App\Models\Source;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $source_wa_centers = [
            'Sales',
            'Customer Support',
        ];

        $source_calls = [
            'Sales',
            'Customer Support',
        ];

        $source_websites = [
            'Tawk to',
            'Lead From',
        ];

        $source_digital_platforms = [
            'Google Business',
            'Facebook',
            'Instagram',
            'Google Ads',
            'Tiktok',
            'Meta Ads',
        ];

        // insert data to database
        Source::insert(array_map(function ($source) {
            return [
                'name' => $source,
                'media_id' => 1, // 'WhatsApp Center'
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $source_wa_centers));

        Source::insert(array_map(function ($source) {
            return [
                'name' => $source,
                'media_id' => 2, // 'Calls'
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $source_calls));

        Source::insert(array_map(function ($source) {
            return [
                'name' => $source,
                'media_id' => 3, // 'Websites'
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $source_websites));

        Source::insert(array_map(function ($source) {
            return [
                'name' => $source,
                'media_id' => 14, // 'Digital Platforms'
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $source_digital_platforms));
    }
}
