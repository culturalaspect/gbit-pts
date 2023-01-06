<?php

namespace App\Http\Livewire\Company;

use App\Models\CompanyPerformanceMeasure;
use Livewire\Component;
use DB;

class CompanyIndex extends Component
{
    protected $page_title = "Performance Monitoring Information System | G-Link | Dashboard";
    protected $main_title = "Dashboard";
    protected $breadcrumb_title = "Dashboard";
    protected $selected_main_menu = "admin_dashboard";
    protected $card_title;
    protected $selected_sub_menu;

    public $dw_sep_array = array();
    public $cw_sep_array = array();

    public function render()
    {
        $this->selected_sub_menu = "admin_dashboard";
        $this->card_title = "Admin Dashboard";

        $top_cards_data = array();

        $total_sanctioned = DB::select(DB::raw("
            SELECT
            ROUND((SUM(company_financials.total_sanctioned_amount))/1000000, 2) AS total_sanctioned_amount,
            SUM(company_financials.total_installments) AS total_installments
            FROM companies
            INNER JOIN company_financials
            ON company_financials.company_id = companies.id
            WHERE company_financials.is_sanctioned_by_kcbl = 1
            AND companies.id = ".auth()->user()->company_id.";
        "));

        $total_returned = DB::select(DB::raw("
            SELECT
                ROUND((SUM(amount_paid)/1000000) , 2) AS total_returned,
                COUNT(*) AS total_installments_paid
            FROM company_installments
            WHERE company_id = ". auth()->user()->company_id ."
        "));



        $top_cards_data['total_sanctioned'] = $total_sanctioned[0];
        $top_cards_data['total_returned'] = $total_returned[0];

        //dd($top_cards_data);

        $companies = DB::select(DB::raw("
            SELECT
                companies.id,
                companies.company_name,
                schemes.scheme_name,
                phases.id AS phase_id,
                phases.phase_name,
                (SELECT SUM(company_financials.total_sanctioned_amount) FROM company_financials WHERE company_financials.is_sanctioned_by_kcbl = 1) AS grand_total_sanctioned_amount,
                company_financials.total_sanctioned_amount,
                ROUND((company_financials.total_sanctioned_amount/1000000), 2) AS total_sanctioned_amount_in_m
            FROM companies
            INNER JOIN company_financials
            ON company_financials.company_id = companies.id
            INNER JOIN phases
            ON company_financials.phase_id = phases.id
            INNER JOIN schemes
            ON phases.scheme_id = schemes.id
            WHERE company_financials.is_sanctioned_by_kcbl = 1
            AND companies.id = ". auth()->user()->company_id ."
            ORDER BY phases.id, company_financials.total_sanctioned_amount DESC;
        "));

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
                WHERE companies.id = '.auth()->user()->company_id.';
            ')
        );

        $cpms = CompanyPerformanceMeasure::where('company_id', auth()->user()->company_id)->with(['phase', 'measure'])->where('is_completed', false)->get();

        return view('livewire.company.company-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('companies', $companies)
                ->with('top_cards_data', $top_cards_data)
                ->with('company_financials', $company_financials)
                ->with('cpms', $cpms)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
