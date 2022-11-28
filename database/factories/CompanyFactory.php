<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Company;
use App\Models\District;
use App\Models\Phase;
use Illuminate\Database\Eloquent\Factories\Factory;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $total_revenue = fake()->randomFloat(2, 20000, 2500000);
        $total_profit = fake()->randomFloat(2, 0, $total_revenue);
        $total_sanctioned_amount = fake()->numberBetween(800000, 1500000);
        $installment_amount = ((($total_sanctioned_amount/100)*5) + $total_sanctioned_amount)/36;
        return [
            'company_name' => fake()->company(),
            'ceo_name' => fake()->name(),
            'address' => fake()->address(),
            'cell_no' => '03'.fake()->randomNumber(9),
            'official_email' => fake()->freeEmail,
            'online_profile_link' => fake()->url,
            'total_employees' => fake()->numberBetween(4, 200),
            'total_revenue' => $total_revenue,
            'total_profit' => $total_profit,
            'category_id' => Category::inRandomOrder()->take(1)->first()->id,
            'district_id' => District::inRandomOrder()->take(1)->first()->id,
            'phase_id' => Phase::inRandomOrder()->take(1)->first()->id,
            'total_sanctioned_amount' => $total_sanctioned_amount,
            'total_installments' => 36,
            'installment_markup_percentage' => 5,
            'installment_amount' => $installment_amount,
            'is_sanctioned_by_kcbl' => fake()->numberBetween(0, 1),
            'is_completed_by_kcbl' => fake()->numberBetween(0, 1),
            'updated_at' => fake()->dateTime($max = 'now', $timezone = null),
            'created_at' =>  fake()->dateTime($max = 'now', $timezone = null)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
