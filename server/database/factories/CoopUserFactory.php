<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\CoopUser;
use App\Models\LicenseInformation;
use App\Models\AccountInformation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\coop_user>
 */
class CoopUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $coopUserCount = CoopUser::count();
        $childStatus = $coopUserCount == 0 ? 0 : $this->faker->randomElement([0, 1]);
        return [
            'email_address' => function (){
                return CoopUser::count() === 0 ? 'coop@gmail.com' : $this->faker->email;
            },
            'password' => Hash::make('coop'), // ハッシュ化したデフォルトのパスワード
            'coop_name' => $this->faker->company,
            'representative_last_name' => $this->faker->lastName,
            'representative_first_name' => $this->faker->firstName,
            'representative_last_name_kana' => $this->faker->lastKanaName,
            'representative_first_name_kana' => $this->faker->firstKanaName,
            'license_information_id' => LicenseInformation::inRandomOrder()->first()->id, // 適切なランダムな値に置き換える
            'account_information_id' => AccountInformation::inRandomOrder()->first()->id, // 適切なランダムな値に置き換える
            'employees' => $this->faker->numberBetween(1, 100),
            'phone_number' => $this->faker->numerify('###########'),
            'land_or_air' => $this->faker->randomElement([1, 2]), // 適切なランダムな値に置き換える
            'application_status' => $this->faker->randomElement([1, 2, 3]), // 適切なランダムな値に置き換える
            'child_status' => $childStatus,
            'pair_id' => $childStatus == 1 ? CoopUser::inRandomOrder()->first()->id : null,
            'pay_status' => $this->faker->randomElement([0, 1]),
            'amount_of_compensation' => $this->faker->numberBetween(10000, 1000000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
