<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'grid_size' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->sentence(),
            'creator_id' => User::inRandomOrder()->first()
        ];
    }

    public function withTags()
    {
        return $this->has(
            Tag::factory(2),
            'tags',
        );
    }

    public function withCategories()
    {
        return $this->has(
            Category::factory(2),
            'categories',
        );
    }
}
