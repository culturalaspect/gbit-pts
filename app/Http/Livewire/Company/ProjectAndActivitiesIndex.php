<?php

namespace App\Http\Livewire\Company;

use App\Models\Category;
use App\Models\Company;
use App\Models\District;
use App\Models\Project;
use App\Models\User;
use Livewire\Component;

use Hash;

class ProjectAndActivitiesIndex extends Component
{
    protected $page_title = "Performance Monitoring Information System | G-Link | Projects and Activities";
    protected $main_title = "Projects and Activities";
    protected $breadcrumb_title = "Projects and Activities";
    protected $selected_main_menu = "admin_project_activities";
    protected $card_title;
    protected $selected_sub_menu;

    //public $company;
    public $projects;
    /* public $activities;
    public $ceo_name;
    public $address;
    public $cell_no;
    public $official_email;
    public $category_id;
    public $district_id;
    public $online_profile_link;
    public $total_employees;
    public $total_revenue;
    public $total_profit;
    public $is_completed;
    public $startup_stage;
    public $current_assets; */

    public function mount() {
        //$this->company = Company::where('id', auth()->user()->company_id)->first();
        $this->projects = Project::where('company_id', auth()->user()->company_id)->get();
        /* $this->ceo_name = $this->company->ceo_name;
        $this->address = $this->company->address;
        $this->cell_no = $this->company->cell_no;
        $this->official_email = $this->company->official_email;
        $this->category_id = $this->company->category_id;
        $this->district_id = $this->company->district_id;
        $this->online_profile_link = $this->company->online_profile_link;
        $this->total_employees = $this->company->total_employees;
        $this->total_revenue = $this->company->total_revenue;
        $this->total_profit = $this->company->total_profit;
        $this->is_completed = $this->company->is_completed;
        $this->startup_stage = $this->company->startup_stage;
        $this->current_assets = $this->company->current_assets; */
    }

    public function save()
    {
        /* $company = $this->company;
        $validateData = [
            'ceo_name' => 'required|min:3',
            'address' => 'required|min:3',
            'cell_no' => 'required|min:11',
            'official_email' => 'required|email',
            'online_profile_link' => 'required|url',
            'total_employees' => 'required|integer|gte:1',
            'total_revenue' => 'required|numeric|gte:0',
            'total_profit' => 'required|numeric|gte:0',
            'category_id' => 'required|integer',
            'district_id' => 'required|integer',
            'startup_stage' => 'required|string',
            'current_assets' => 'required|min:3',
        ];

        $this->validate($validateData);

        $company->ceo_name = $this->ceo_name;
        $company->address = $this->address;
        $company->cell_no = $this->cell_no;
        $company->official_email = $this->official_email;
        $company->online_profile_link = $this->online_profile_link;
        $company->total_employees = $this->total_employees;
        $company->total_revenue = $this->total_revenue;
        $company->total_profit = $this->total_profit;
        $company->category_id = $this->category_id;
        $company->district_id = $this->district_id;
        $company->startup_stage = $this->startup_stage;
        $company->current_assets = $this->current_assets;
        $company->is_completed = 1;
        $company->save();

        $this->dispatchBrowserEvent('showSuccessToast');
        $this->cleanVars();
        return redirect()->to('company/dashboard')->with('message','Successfully Updated Profile.'); */
    }

    private function cleanVars()
    {
        /* $this->password = null;
        $this->old_password = null;
        $this->confirm_password = null; */
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_project_activities";
        $this->card_title = "Projects and Activities";

        return view('livewire.company.projects-activities-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('projects', $this->projects)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
