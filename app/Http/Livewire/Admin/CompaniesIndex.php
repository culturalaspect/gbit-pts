<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Company;
use App\Models\District;
use App\Models\Phase;
use App\Models\Scheme;
use Livewire\Component;

class CompaniesIndex extends Component
{
    protected $page_title = "Performance Monitoring Information System | G-Link | Companies";
    protected $main_title = "Companies";
    protected $breadcrumb_title = "Companies";
    protected $selected_main_menu = "admin_companies";
    protected $card_title;
    protected $selected_sub_menu;

    public $action;
    public $selectedItem;

    public $modelId;
    public $company_name;
    public $ceo_name;
    public $address;
    public $cell_no;
    public $official_email;
    public $online_profile_link;
    public $is_completed;
    public $total_employees;
    public $total_revenue;
    public $total_profit;
    public $category_id;
    public $district_id;
    public $startup_stage;
    public $current_assets;

    public $is_loading;

    public $deleteErrorMessage = 'Deleted Record Successfully';


    protected $listeners = [
        'getModelId',
        'hideModal',
        'openModal',
        'closeModal',
        'refreshParent' => '$refresh',
        'selectItem' => 'selectItem'
    ];

    public function selectItem($item)
    {
        $itemId = $item[0];
        $action = $item[1];
        $this->selectedItem = $itemId;

        if ($action == 'delete') {
            // This will show the modal on the frontend
            $this->dispatchBrowserEvent('showDeleteModal');
        } else {
            $this->resetValidation();
            $this->emit('getModelId', $this->selectedItem);
            $this->dispatchBrowserEvent('showModal');
        }
    }

    public function openModal()
    {
        $this->cleanVars();
        $this->resetValidation();
        $this->dispatchBrowserEvent('showModal');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('hideModal');
        $this->cleanVars();
        $this->resetValidation();
    }

    public function delete()
    {
        $item = Company::find($this->selectedItem);

        if($item){
            try {
                $item->delete();
                $this->dispatchBrowserEvent('hideDeleteModal');
                $this->emit('pg:eventRefresh-default');
                $this->deleteErrorMessage = 'Record Deleted Successfully';
                $this->dispatchBrowserEvent('showErrorToast');

            } catch (\Illuminate\Database\QueryException $e) {
                //var_dump($e->errorInfo);
                if($e->getCode()==23000) {
                    $this->dispatchBrowserEvent('hideDeleteModal');
                    $this->emit('pg:eventRefresh-default');
                    $this->deleteErrorMessage = 'Integrity Constraint Violation! You must delete child records first then you should delete this item to ensure referential integrity.';
                    $this->dispatchBrowserEvent('showErrorToast');

                } else {
                    $this->dispatchBrowserEvent('hideDeleteModal');
                    $this->emit('pg:eventRefresh-default');
                    $this->deleteErrorMessage = 'Something Went Wrong! Please Try Again Later.';
                    $this->dispatchBrowserEvent('showErrorToast');
                }
            }
        }
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = Company::find($this->modelId);

        $this->company_name = $model->company_name;
        $this->ceo_name = $model->ceo_name;
        $this->address = $model->address;
        $this->cell_no = $model->cell_no;
        $this->official_email = $model->official_email;
        $this->online_profile_link = $model->online_profile_link;
        $this->total_employees = $model->total_employees;
        $this->total_revenue = $model->total_revenue;
        $this->total_profit = $model->total_profit;
        $this->category_id = $model->category_id;
        $this->district_id = $model->district_id;
        $this->is_completed = $model->is_completed;
        $this->startup_stage = $model->startup_stage;
        $this->current_assets = $model->current_assets;
    }

    public function save()
    {
        $this->is_loading = true;
        // Data validation
        $validateData = [
            'company_name' => 'required|min:3',
            'ceo_name' => 'nullable|min:3',
            'address' => 'nullable|min:3',
            'cell_no' => 'nullable|min:11',
            'official_email' => 'nullable|email',
            'online_profile_link' => 'nullable|url',
            'total_employees' => 'nullable|integer|gte:1',
            'total_revenue' => 'nullable|numeric|gte:0',
            'total_profit' => 'nullable|numeric|gte:0',
            'category_id' => 'nullable|integer',
            'district_id' => 'nullable|integer',
            'is_completed' => 'required|integer',
            'startup_stage' => 'nullable',
            'current_assets' => 'nullable|min:3'
        ];

        // Default data
        $data = [
            'company_name' => $this->company_name,
            'ceo_name' => $this->ceo_name,
            'address' => $this->address,
            'cell_no' => $this->cell_no,
            'official_email' => $this->official_email,
            'online_profile_link' => $this->online_profile_link,
            'total_employees' => $this->total_employees,
            'total_revenue' => $this->total_revenue,
            'total_profit' => $this->total_profit,
            'category_id' => $this->category_id,
            'district_id' => $this->district_id,
            'is_completed' => $this->is_completed,
            'startup_stage' => $this->startup_stage,
            'current_assets' => $this->current_assets
        ];

        $this->validate($validateData);

        if ($this->modelId) {
            Company::find($this->modelId)->update($data);
            $postInstanceId = $this->modelId;
        } else {
            $postInstance = Company::create($data);
            //$postInstanceId = $postInstance->id;
        }

        $this->emit('refreshParent');
        $this->emit('pg:eventRefresh-default');
        $this->dispatchBrowserEvent('showSuccessToast');
        $this->dispatchBrowserEvent('hideModal');
        $this->cleanVars();

        $this->is_loading = false;
    }

    public function forcedCloseModal()
    {
        // This is to reset our public variables
        $this->cleanVars();

        // These will reset our error bags
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function cleanVars()
    {
        $this->modelId = null;

        $this->company_name = null;
        $this->ceo_name = null;
        $this->address = null;
        $this->cell_no = null;
        $this->official_email = null;
        $this->online_profile_link = null;
        $this->total_employees = null;
        $this->total_revenue = null;
        $this->total_profit = null;
        $this->category_id = null;
        $this->district_id = null;
        $this->is_completed = null;
        $this->startup_stage = null;
        $this->current_assets = null;

    }

    public function render()
    {
        $this->selected_sub_menu = "admin_companies";
        $this->card_title = "Companies";

        $categories = Category::all();
        $districts = District::all();
        $phases = Phase::all();

        return view('livewire.admin.companies-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('categories', $categories)
                ->with('districts', $districts)
                ->with('phases', $phases)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
