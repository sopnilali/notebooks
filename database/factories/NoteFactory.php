<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'tags' => fake()->randomElements(['Laravel', 'Blade', 'CSS', 'PHP'], 2),
            'body' => fake()->paragraphs(3, true),
        ];
    }
}
