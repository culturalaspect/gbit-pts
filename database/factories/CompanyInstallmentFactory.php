<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CompanyInstallment;
use Illuminate\Database\Eloquent\Factories\Factory;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CompanyInstallmentFactory extends Factory
{
    protected $model = CompanyInstallment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $company = Company::where('is_sanctioned_by_kcbl', 1)->inRandomOrder()->take(1)->first();
        //dd($company);
        $installment = CompanyInstallment::where('company_id', $company->id)->orderBy('installment_no', 'DESC')->first();
        if($installment) {
            $installment_no = $installment->installment_no + 1;
        } else {
            $installment_no = 1;
        }
        $amount_paid = $company->installment_amount;
        $date_of_payment = fake()->date($format = 'Y-m-d', $max = 'now');

        return [
            'company_id' => $company->id,
            'installment_no' => $installment_no,
            'amount_paid' => $amount_paid,
            'date_of_payment' => $date_of_payment,
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
