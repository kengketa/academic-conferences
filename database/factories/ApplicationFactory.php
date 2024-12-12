<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->numberBetween(2, 6);
        $proposer = User::whereNotNull('major_id')->inRandomOrder()->first() ?? User::factory();
        $proposerDepartmentId = $proposer->major->department->id;
        $data = [
            'name' => $this->faker->text(50),
            'type' => $this->faker->randomElement(['international', 'local']),
            'organized_by' => [$this->faker->company, $this->faker->company],
            'number_of_seminar_done' => $this->faker->numberBetween(1, 20),
            'references' => [$this->faker->url, $this->faker->url],
            'relate_majors' => [$this->faker->sentence, $this->faker->sentence],
            'relate_curriculum' => [$this->faker->sentence, $this->faker->sentence],
            'other_info' => $this->faker->paragraph,
            'proposed_by' => $proposer->id,
            'proposer_signature' => Str::random(500),
            'proposed_at' => now(),
            'status' => $status,
        ];
        if ($status >= 3) {
            $data['dean_comment'] = $this->faker->paragraph;
            $data['dean_comment'] = $this->faker->paragraph;
            $data['dean_signature'] = Str::random(500);
            $data['dean_commented_by'] = User::whereHas('major.department', function ($q) use ($proposerDepartmentId) {
                $q->where('id', $proposerDepartmentId);
            })->inRandomOrder()->first()->id;
            $data['dean_commented_at'] = now();
        }
        if ($status >= 4) {
            $data['chairman_comment'] = $this->faker->paragraph;
            $data['chairman_signature'] = Str::random(500);
            $data['chairman_commented_by'] = User::inRandomOrder()->first()->id ?? User::factory();
            $data['chairman_commented_at'] = now();
        }
        if ($status >= 5) {
            $data['president_comment'] = $this->faker->paragraph;
            $data['president_signature'] = Str::random(500);
            $data['president_commented_by'] = User::inRandomOrder()->first()->id ?? User::factory();
            $data['president_commented_at'] = now();
        }
        if ($status >= 6) {
            $data['secretary_comment'] = $this->faker->paragraph;
            $data['secretary_signature'] = Str::random(500);
            $data['secretary_commented_by'] = User::inRandomOrder()->first()->id ?? User::factory();
            $data['secretary_commented_at'] = now();
        }
        return $data;
    }
}
