<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    private function getRandomImagePath() : string {
        $imageDirectory = public_path('images/factory');
        $image_paths = array_diff(scandir($imageDirectory), ['.', '..']);

        try {
            $randomImagepath = 'images/factory/' . $image_paths[array_rand($image_paths)];            
        } catch (\Exception $e) {
            $randomImagepath = 'optimized_optimized_1729794763.jpg';
        }


        return $randomImagepath;
    }
    
    public function definition(): array
    {        
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'phone_number' => fake()->phoneNumber(),
            'picture_path' => $this -> getRandomImagePath(),
        ];
    }
    

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
