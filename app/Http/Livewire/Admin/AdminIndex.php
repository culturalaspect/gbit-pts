<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use DB;

class AdminIndex extends Component
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

        $schemes_sum = DB::select(DB::raw("
            SELECT ROUND((SUM(sanctioned_amount))/1000000, 2) AS total_approved_amount FROM schemes
        "));

        $total_sanctioned = DB::select(DB::raw("
            SELECT COUNT(*) AS total_sanctioned_companies,
            ROUND((SUM(total_sanctioned_amount))/1000000, 2) AS total_sanctioned_amount,
            (SELECT COUNT(*) FROM companies) AS total_companies
            FROM companies
            INNER JOIN company_financials
            ON company_financials.company_id = companies.id
            WHERE company_financials.is_sanctioned_by_kcbl = 1;
        "));

        $top_cards_data['schemes_sum'] = $schemes_sum[0];
        $top_cards_data['total_sanctioned'] = $total_sanctioned[0];

        // $sanctioned_companies = DB::select(DB::raw("
        //     SELECT
        //         companies.id,
        //         companies.company_name,
        //         companies.total_sanctioned_amount,
        //         ROUND((companies.total_sanctioned_amount)/1000000, 2) AS total_sanctioned_amount_in_m,
        //         phases.phase_name
        //     FROM companies
        //     INNER JOIN phases
        //     ON companies.phase_id = phases.id
        //     WHERE companies.is_sanctioned_by_kcbl = 1
        //     ORDER BY phases.id desc;
        // "));

        $districtwise_sanctions = DB::select(DB::raw("
            SELECT
                districts.id,
                districts.district_name,
                COUNT(*) as total_companies,
                SUM(company_financials.total_sanctioned_amount) AS total_amount,
                ROUND((SUM(company_financials.total_sanctioned_amount)/1000000), 2) AS total_amount_in_m
            FROM companies
            INNER JOIN company_financials
            ON company_financials.company_id = companies.id
            INNER JOIN districts
            ON companies.district_id = districts.id
            WHERE company_financials.is_sanctioned_by_kcbl = 1
            GROUP BY districts.id, districts.district_name;
        "));



        foreach($districtwise_sanctions as $dw_sanction){
            $this->dw_sep_array['district_ids'][] = $dw_sanction->id;
            $this->dw_sep_array['district_names'][] = $dw_sanction->district_name;
            $this->dw_sep_array['total_companies'][] = $dw_sanction->total_companies;
            $this->dw_sep_array['total_amount'][] = $dw_sanction->total_amount;
            $this->dw_sep_array['total_amount_in_m'][] = $dw_sanction->total_amount_in_m;
            $this->dw_sep_array['colors'][] = fake()->hexColor();
        }

        $categorywise_sanctions = DB::select(DB::raw("
            SELECT
                categories.id,
                categories.category_name,
                COUNT(*) as total_companies,
                SUM(company_financials.total_sanctioned_amount) AS total_amount,
                ROUND((SUM(company_financials.total_sanctioned_amount)/1000000), 2) AS total_amount_in_m
            FROM companies
            INNER JOIN company_financials
            ON company_financials.company_id = companies.id
            INNER JOIN categories
            ON companies.category_id = categories.id
            WHERE company_financials.is_sanctioned_by_kcbl = 1
            GROUP BY categories.id, categories.category_name;
        "));

        foreach($categorywise_sanctions as $sw_sanction){
            $this->cw_sep_array['category_ids'][] = $sw_sanction->id;
            $this->cw_sep_array['category_names'][] = $sw_sanction->category_name;
            $this->cw_sep_array['total_companies'][] = $sw_sanction->total_companies;
            $this->cw_sep_array['total_amount'][] = $sw_sanction->total_amount;
            $this->cw_sep_array['total_amount_in_m'][] = $sw_sanction->total_amount_in_m;
            $this->cw_sep_array['colors'][] = '#1e88e5';
        }

        //dd($this->cw_sep_array);

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
            ORDER BY phases.id, company_financials.total_sanctioned_amount DESC;
        "));

        //dd($companies);

        $activities = DB::select(DB::raw("
            SELECT
            (SELECT count(*) FROM projects) AS total_projects,
            (SELECT count(*) FROM activities) AS total_activities,
            (SELECT count(*) FROM activities WHERE status = 0) AS total_in_progress_activities,
            (SELECT count(*) FROM activities WHERE status = 1) AS total_in_completed_activities,
            (SELECT count(*) FROM activities WHERE status = 2) AS total_in_not_applicable_activities
        "));

        return view('livewire.admin.admin-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('dw_sep_array', $this->dw_sep_array)
                ->with('cw_sep_array', $this->cw_sep_array)
                ->with('companies', $companies)
                ->with('activities', $activities)
                ->with('top_cards_data', $top_cards_data)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
