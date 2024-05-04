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
        return $this->afterCreating(function (Gallery $gallery) {
            $tags = Tag::inRandomOrder()->take(rand(1, 3))->get();
            $gallery->tags()->attach($tags);
        });
    }

    public function withCategories()
    {
        return $this->afterCreating(function (Gallery $gallery) {
            $categories = Category::inRandomOrder()->take(rand(1, 3))->get();
            $gallery->categories()->attach($categories);
        });
    }

    public function withImages()
    {
        return $this->afterCreating(function (Gallery $gallery) {
            collect(range(1, rand(1, 3)))->each(function () use ($gallery) {
                $gallery->addMediaFromUrl($this->faker->imageUrl())->toMediaCollection('images');
            });
        });
    }
}
