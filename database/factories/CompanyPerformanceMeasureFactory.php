<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CompanyPerformanceMeasure;
use App\Models\PerformanceMeasure;
use Illuminate\Database\Eloquent\Factories\Factory;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CompanyPerformanceMeasureFactory extends Factory
{
    protected $model = CompanyPerformanceMeasure::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $company = Company::where('is_sanctioned_by_kcbl', 1)->inRandomOrder()->take(1)->first();
        //dd($company);
        $measure_id = PerformanceMeasure::inRandomOrder()->take(1)->first()->id;
        $total_employees = fake()->numberBetween(20, $company->total_employees);
        $total_revenue = fake()->randomFloat(2, $company->total_sanctioned_amount-200000, $company->total_revenue);
        $total_profit = fake()->randomFloat(2, $company->total_sanctioned_amount-400000, $total_revenue);
        $total_amount_utilized = $company->total_sanctioned_amount;


        return [
            'company_id' => $company->id,
            'measure_id' => $measure_id,
            'total_employees' => $total_employees,
            'total_revenue' => $total_revenue,
            'total_profit' => $total_profit,
            'total_amount_utilized' => $total_amount_utilized,
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
