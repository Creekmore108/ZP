<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{

    protected $model = Reservation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'asset_id' => Asset::factory(),
            'price' => $this->faker->numberBetween(10_000, 20_000),
            'status' => Reservation::STATUS_ACTIVE,
            'start_date' => now()->addDay(1)->format('Y-m-d'),
            'end_date' => now()->addDay(5)->format('Y-m-d'),
            'title' => $this->faker->word,
            'editable' => 1,
            'start_editable' => 1,
            'duration_editable' => 1,
            'resource_editable' => 1,
            'display' =>'test',
            'overlap' => 1,
            'event_constraint' => 'con',
            'background_color' => $this->faker->safeColorName(),
            'text_color' => $this->faker->safeColorName(),
            'border_color' => $this->faker->safeColorName(),
            'extended_props' => 'extended',
            'source' => 'src',

        ];
    }
    public function cancelled(): Factory
    {
        return $this->state([
            'status' => Reservation::STATUS_CANCELLED,
        ]);
    }
}
