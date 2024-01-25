<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Asset;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'featured_image_id' => $this->faker->randomDigit(),
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'location' => $this->faker->city,
            'address_line1' => $this->faker->address,
            'approval_status' => Asset::APPROVAL_APPROVED,
            'hidden' => false,
            'price_per_day' => $this->faker->numberBetween(1_000, 2_000),
        ];
    }
    public function pending(): Factory
    {
        return $this->state([
            'approval_status' => Asset::APPROVAL_PENDING,
        ]);
    }

    public function hidden(): Factory
    {
        return $this->state([
            'hidden' => true,
        ]);
    }
}
