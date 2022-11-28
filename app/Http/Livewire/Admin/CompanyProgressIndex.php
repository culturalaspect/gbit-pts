<?php

namespace App\Http\Livewire\Admin;

use App\Models\Company;
use App\Models\CompanyFinancial;
use App\Models\CompanyInstallment;
use App\Models\CompanyPerformanceMeasure;
use Livewire\Component;
use DB;

class CompanyProgressIndex extends Component
{
    protected $page_title = "Performance Tracking System | G-Link | Company Progress";
    protected $main_title = "Company Progress";
    protected $breadcrumb_title = "Company Progress";
    protected $selected_main_menu = "admin_dashboard";
    protected $card_title;
    protected $selected_sub_menu;

    public $company_id;
    public $phase_id;

    public function mount($company_id, $phase_id)
    {
        if(auth()->user()->role_id == 3) {
            if(auth()->user()->company_id != $company_id) {
                return redirect()->to('company/dashboard')->with('message','Sorry you do not have permission to perform this operation. Please try again later.');
            }
        }

        $this->company_id = $company_id;
        $this->phase_id = $phase_id;
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_dashboard";
        $this->card_title = "Company Progress";

        $graph_array = array();

        $company = Company::find($this->company_id);
        $installments = CompanyInstallment::where('company_id', $company->id)->where('phase_id', $this->phase_id)->get();

        $cpms = CompanyPerformanceMeasure::where('company_id', $company->id)->where('phase_id', $this->phase_id)->orderBy('measure_id', 'DESC')->get();
        //$company_financials = CompanyFinancial::where('company_id', $company->id)->where('phase_id', $this->phase_id)->first();

        $company_financials = DB::select(
            DB::raw('
                SELECT
                    companies.id,
                    companies.company_name,
                    company_financials.phase_id,
                    phases.phase_name AS phase_name,
                    company_financials.total_sanctioned_amount,
                    company_financials.installment_amount,
                    company_financials.installment_markup_percentage,
                    IF(company_financials.is_sanctioned_by_kcbl = 1, "Yes", "No") AS is_sanctioned_by_kcbl,
                    IF(company_financials.is_completed_by_kcbl = 1, "Yes", "No") AS is_completed_by_kcbl,
                    company_financials.total_installments,
                    (
                        SELECT COUNT(*) FROM company_installments WHERE company_installments.company_id = companies.id AND company_installments.phase_id = company_financials.phase_id
                    ) AS total_paid_installments,
                    (company_financials.total_installments - (SELECT total_paid_installments)) AS total_remaining_installments,
                    (
                        (
                            (
                                company_financials.total_sanctioned_amount/100
                            ) * company_financials.installment_markup_percentage
                        ) +
                        company_financials.total_sanctioned_amount
                    ) AS total_amount_with_markup,
                    (
                        SELECT SUM(company_installments.amount_paid) FROM company_installments WHERE company_installments.company_id = companies.id and company_installments.phase_id = company_financials.phase_id
                    ) AS total_recovered_amount,
                    ((SELECT total_amount_with_markup) - (SELECT total_recovered_amount)) AS total_difference_amount
                FROM companies
                INNER JOIN company_financials
                ON company_financials.company_id = companies.id
                INNER JOIN phases
                ON company_financials.phase_id = phases.id
                WHERE companies.id = '. $this->company_id .'
                AND company_financials.phase_id = '. $this->phase_id .';
            ')
        );

        $graph_array["total_employees"][] = $company->total_employees;
        $graph_array["total_revenue"][] = $company->total_revenue;
        $graph_array["total_profit"][] = $company->total_profit;
        $graph_array["total_loan_utilization"][] = 0;
        $graph_array["x-axis"][] = 'Initial';

        foreach($cpms as $cpm) {
            $graph_array["total_employees"][] = $cpm->total_employees;
            $graph_array["total_revenue"][] = $cpm->total_revenue;
            $graph_array["total_profit"][] = $cpm->total_profit;
            $graph_array["total_loan_utilization"][] = $cpm->total_amount_utilized;
            $graph_array["x-axis"][] = $cpm->measure->measure_name;
        }

        $this->breadcrumb_title = $company->company_name;

        return view('livewire.admin.company-progress-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('company', $company)
                ->with('installments', $installments)
                ->with('cpms', $cpms)
                ->with('graph_array', $graph_array)
                ->with('company_financials', $company_financials[0])
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
