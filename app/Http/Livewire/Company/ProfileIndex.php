<?php

namespace App\Http\Livewire\Company;

use App\Models\Category;
use App\Models\Company;
use App\Models\District;
use App\Models\User;
use Livewire\Component;

use Hash;

class ProfileIndex extends Component
{
    protected $page_title = "Performance Tracking System | G-Link | Profile";
    protected $main_title = "Profile";
    protected $breadcrumb_title = "Profile";
    protected $selected_main_menu = "admin_profile";
    protected $card_title;
    protected $selected_sub_menu;

    public $company;
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

    public function mount() {
        $this->company = Company::where('id', auth()->user()->company_id)->first();
        $this->ceo_name = $this->company->ceo_name;
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
    }

    public function save()
    {
        $company = $this->company;
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
            'district_id' => 'required|integer'
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
        $company->is_completed = 1;
        $company->save();

        $this->dispatchBrowserEvent('showSuccessToast');
        $this->cleanVars();
        return redirect()->to('company/dashboard')->with('message','Successfully Updated Profile.');
    }

    private function cleanVars()
    {
        $this->password = null;
        $this->old_password = null;
        $this->confirm_password = null;
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_profile";
        $this->card_title = "Profile";

        $categories =Category::all();
        $districts =District::all();

        return view('livewire.company.profile-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('categories', $categories)
                ->with('districts', $districts)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
