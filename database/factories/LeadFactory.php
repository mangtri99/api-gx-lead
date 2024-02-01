<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomBranch = \App\Models\Branch::inRandomOrder()->first();
        $randomStatus = \App\Models\Status::inRandomOrder()->first();
        $randomProbability = \App\Models\Probability::inRandomOrder()->first();
        $randomType = \App\Models\Type::inRandomOrder()->first();
        $randomChannel = \App\Models\Channel::inRandomOrder()->first();

        // get random media by channel
        $randomMedia = \App\Models\Media::where('channel_id', $randomChannel->id)->inRandomOrder()->first();

        // get random source by media
        $randomSource = \App\Models\Source::where('media_id', $randomMedia->id)->inRandomOrder()->first();

        // 2Digit Alphabhet + 8Digit Number
        $leadNumber = $this->faker->unique()->regexify('[A-Z]{2}[0-9]{8}');

        return [
            'branch_id' => $randomBranch->id,
            'status_id' => $randomStatus->id,
            'probability_id' => $randomProbability->id,
            'type_id' => $randomType->id,
            'channel_id' => $randomChannel->id,
            'media_id' => $randomMedia ? $randomMedia->id : null,
            'source_id' => $randomSource ? $randomSource->id : null,
            'lead_number' => $leadNumber,
            'fullname' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->unique()->phoneNumber,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'company_name' => $this->faker->company,
            'notes' => $this->faker->text,
        ];
    }
}
