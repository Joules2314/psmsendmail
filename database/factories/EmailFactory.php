<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\email>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => $this->faker->sentence(),
            'to' => $this->faker->email(),
            'cc' => $this->faker->email(),
            'bcc'=> $this->faker->email(),
            'body'=> $this->faker->paragraph(3, true),
            'attachments'=> json_encode([
                'document.pdf',
                'image.png',
            ]),
            'user_id'=>User::factory(),
            'user_name'=> $this->faker->name(),
            'system_name'=>$this->faker->randomElement(['Gmail', 'Outlook', 'Thunderbird']),
            'created_at'=>now(),
        ];
    }
}
