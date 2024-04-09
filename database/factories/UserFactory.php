<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $faker = \Faker\Factory::create('ar_SA'); // Set the locale to Arabic

        $gender = $this->faker->randomElement(["ذكر", "أنثى"]);
        $firstName = ($gender === "ذكر") ? $faker->firstNameMale : $faker->firstNameFemale;
        $middleName = $faker->firstName; // Generating a random middle name
        $lastName = $faker->lastName;

        return [
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password123'), // You may want to use a stronger password hashing mechanism
            'name' => $firstName . ' ' . $middleName . ' ' . $lastName,
            'phone_number' => '05' . $this->faker->numberBetween(100000000, 999999999),
            'gender' => $gender,
            'year' => $this->faker->randomElement(["أولى", "ثانية", "ثالثة", "رابعة", "خامسة", "خريج"]),
            'status' => $this->faker->randomElement(["نشط", "مجمد", "موقوف", "منسحب", null]),
            'student_number' => $this->faker->numberBetween(10000000, 99999999),
            'schedule' => $this->faker->randomElement([
                'مستقرة بالحرم الجامعي',
                'تدريب خارج الجامعة',
                'أتدرب خارج الجامعة بالإضافة إلى محاضرات منتظمة'
            ]),
            'can_be_teacher' => $this->faker->randomElement([0, 1]),
            'tajweed_certificate' => $this->faker->randomElement([0, 1]),
            'locked' => $this->faker->randomElement([0, 1]),
            'force_information_update' => $this->faker->randomElement([0, 1]),
            'view_notify_on_landing_page' => $this->faker->randomElement([0, 1]),
            'college_id' => $this->faker->numberBetween(1, 13),
            'group_id' => null,
            'cover_image_id' => 1,
            'profile_image_id' => 2,
            'email_verified_at' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        ];
    }
}
