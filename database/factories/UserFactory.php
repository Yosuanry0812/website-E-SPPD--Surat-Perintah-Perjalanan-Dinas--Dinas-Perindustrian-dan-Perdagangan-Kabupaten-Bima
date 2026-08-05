<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'nip' => fake()->unique()->numerify('################'),
            'nama_lengkap' => fake()->name(),
            'jabatan' => fake()->jobTitle(),
            'pangkat_golongan' => 'III/a',
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'Staf',
            'remember_token' => fake()->unique()->bothify('??????????'),
        ];
    }
}
