<?php

namespace App\Http\Livewire\Admin;

use App\Models\Company;
use App\Models\Domain;
use App\Models\Phase;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

use Str;

class CompanyProjectsIndex extends Component
{
    protected $page_title = "Performance Monitoring Information System | G-Link | Company Projects";
    protected $main_title = "Company Projects";
    protected $breadcrumb_title = "Company Projects";
    protected $selected_main_menu;
    protected $card_title;
    protected $selected_sub_menu;

    public $action;
    public $selectedItem;

    public $modelId;
    public $company_id;
    public $project_title;
    public $domain_id;
    public $other_domain;
    public $problem_statement;
    public $summary_of_solution;
    public $expected_results;
    public $organizational_expertise;

    public $is_disabled_other = true;

    public $deleteErrorMessage = 'Deleted Record Successfully';


    protected $listeners = [
        'getModelId',
        'hideModal',
        'openModal',
        'closeModal',
        'calculateLoanAmount',
        'changeOtherDomain',
        'refreshParent' => '$refresh',
        'selectItem' => 'selectItem'
    ];

    public function changeOtherDomain() {
        if(is_null($this->domain_id) || $this->domain_id=="" || $this->domain_id!=9) {
            $this->is_disabled_other = true;
        } else {
            $this->is_disabled_other = false;
        }
    }

    public function is_null_or_empty($field) {
        if($field != "" || $field != null) {
            return $field;
        }

        return 0;
    }

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
        Project::destroy($this->selectedItem);
        $this->dispatchBrowserEvent('hideDeleteModal');
        $this->emit('pg:eventRefresh-default');
        $this->dispatchBrowserEvent('showErrorToast');
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = Project::find($this->modelId);

        $this->id = $model->id;
        $this->company_id = $model->company_id;
        $this->domain_id = $model->domain_id;
        $this->project_title = $model->project_title;
        $this->other_domain = $model->other_domain;
        $this->problem_statement = $model->problem_statement;
        $this->summary_of_solution = $model->summary_of_solution;
        $this->expected_results = $model->expected_results;
        $this->organizational_expertise = $model->organizational_expertise;
    }

    public function save()
    {
        // Data validation
        $validateData = [
            'company_id' => 'required|integer',
            'domain_id' => 'required|integer',
            'project_title' => 'required|min:3',
            //'other_domain' => 'required|integer|gte:1',
            'other_domain' => [
                function ($attribute, $value, $fail) {
                    if ($this->domain_id == 9) {
                        if(is_null($value) || $value == "") {
                            $fail('This field is required.');
                        }

                        if(Str::length($value)<3) {
                            $fail('The :attribute must be at least 3 characters.');
                        }
                    }
                }
            ],
            'problem_statement' => 'required|min:3',
            'summary_of_solution' => 'required|min:3',
            'expected_results' => 'required|min:3',
            'organizational_expertise' => 'required|min:3'
        ];

        // Default data
        $data = [
            'company_id' => $this->company_id,
            'domain_id' => $this->domain_id,
            'project_title' => $this->project_title,
            'other_domain' => $this->other_domain,
            'problem_statement' => $this->problem_statement,
            'summary_of_solution' => $this->summary_of_solution,
            'expected_results' => $this->expected_results,
            'organizational_expertise' => $this->organizational_expertise
        ];

        $this->validate($validateData);

        try {
            if ($this->modelId) {
                Project::find($this->modelId)->update($data);
                $postInstanceId = $this->modelId;
            } else {
                $postInstance = Project::create($data);
                //$postInstanceId = $postInstance->id;
            }

            $this->emit('refreshParent');
            $this->emit('pg:eventRefresh-default');
            $this->dispatchBrowserEvent('showSuccessToast');
            $this->dispatchBrowserEvent('hideModal');
            $this->cleanVars();

        } catch (\Illuminate\Database\QueryException $e) {
            //dd($e->errorInfo);
            if($e->getCode()==23000) {
                $this->dispatchBrowserEvent('hideDeleteModal');
                $this->emit('pg:eventRefresh-default');
                $this->deleteErrorMessage = 'Integrity Constraint Violation! A record with same entry already exists. Please check your entries and try again later.';
                $this->dispatchBrowserEvent('showErrorToast');

            } else {
                $this->dispatchBrowserEvent('hideDeleteModal');
                $this->emit('pg:eventRefresh-default');
                $this->deleteErrorMessage = 'Something Went Wrong! Please Try Again Later.';
                $this->dispatchBrowserEvent('showErrorToast');
            }
        }


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
        $this->company_id = null;
        $this->domain_id = null;
        $this->other_domain = null;
        $this->problem_statement = null;
        $this->summary_of_solution = null;
        $this->expected_results = null;
        $this->organizational_expertise = null;
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_company_projects";
        $this->card_title = "Company Projects";

        $companies = Company::all();
        $domains = Domain::all();

        return view('livewire.admin.company-projects-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('companies', $companies)
                ->with('domains', $domains)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
