<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $urls = [
            'facebook' => fake()->url,
            'twitter' => fake()->url,
            'instagram' => fake()->url,
            'tiktok' => fake()->url,
            'youtube' => fake()->url,
            'linked' => fake()->url,
            'discord' => fake()->url,
        ];

        $user = User::inRandomOrder()->first();

        $location = Location::inRandomOrder()->first()->only(['country', 'city']);

        $data = [
            //
            'user_id' => $user->id,
            'cover_photo' => 'https://picsum.photos/200/300',
            'date_of_birth' => fake()->dateTimeBetween('-40 years', '-14 years'),
            'location' => json_encode($location),
            'website' => fake()->url(),
            'social_urls' => json_encode(array_slice($urls, 0, fake()->numberBetween(2, 6), true)),
            'phone_number_alt' => fake()->phoneNumber(),
            'occupation' => fake()->randomElement([
                'Software Engineer',
                'Teacher',
                'Nurse',
                'Doctor',
                'Lawyer',
                'Accountant',
                'Civil Engineer',
                'Mechanical Engineer',
                'Electrical Engineer',
                'Architect',
                'Pharmacist',
                'Journalist',
                'Graphic Designer',
                'Marketing Specialist',
                'Sales Manager',
                'Financial Analyst',
                'Human Resources Manager',
                'Project Manager',
                'Data Scientist',
                'Environmental Scientist',
                'Social Worker',
                'Chef',
                'Plumber',
                'Electrician',
                'Carpenter',
                'Taxi Driver',
                'Pilot',
                'Flight Attendant',
                'Bank Teller',
                'Customer Service Representative',
            ]),
            'education' => fake()->randomElement([
                "Primary Education",
                "Secondary Education",
                "Certificate /Diploma",
                "Bachelor's Degree",
                "Postgraduate Degree",
                "Master's Degree",
                "Doctorate Degree (Ph.D.)",
            ]),
            'status' => fake()->randomElement([
                'Single',
                'Married',
                'Divorced',
                'Widowed'
            ]),
        ];

        return $data;
    }
}
