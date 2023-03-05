<?php

namespace App\Http\Livewire\Admin;

use App\Models\Company;
use App\Models\Phase;
use App\Models\CompanyFinancial;
use Livewire\Component;

class CompanyFinancialsIndex extends Component
{
    protected $page_title = "Performance Monitoring Information System | G-Link | Company Financials";
    protected $main_title = "Company Financials";
    protected $breadcrumb_title = "Company Financials";
    protected $selected_main_menu;
    protected $card_title;
    protected $selected_sub_menu;

    public $action;
    public $selectedItem;

    public $modelId;
    public $company_id;
    public $phase_id;
    public $total_sanctioned_amount;
    public $total_installments;
    public $installment_markup_percentage;
    public $installment_amount;
    public $is_sanctioned_by_kcbl;
    public $is_completed_by_kcbl;

    public $is_loading = false;

    public $deleteErrorMessage = 'Deleted Record Successfully';


    protected $listeners = [
        'getModelId',
        'hideModal',
        'openModal',
        'closeModal',
        'calculateLoanAmount',
        'refreshParent' => '$refresh',
        'selectItem' => 'selectItem'
    ];

    public function calculateLoanAmount() {
        $this->dispatchBrowserEvent('blockUI');
        $total_sanctioned_amount = $this->is_null_or_empty($this->total_sanctioned_amount);
        $total_installments = $this->is_null_or_empty($this->total_installments);
        $installment_markup_percentage = $this->is_null_or_empty($this->installment_markup_percentage);
        if($total_sanctioned_amount != 0 && $total_installments != 0 && $installment_markup_percentage != 0){
            $this->installment_amount = ((($total_sanctioned_amount/100)* $installment_markup_percentage) + $total_sanctioned_amount)/$total_installments;

        }
        $this->dispatchBrowserEvent('unblockUI');
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
        CompanyFinancial::destroy($this->selectedItem);
        $this->dispatchBrowserEvent('hideDeleteModal');
        $this->emit('pg:eventRefresh-default');
        $this->dispatchBrowserEvent('showErrorToast');
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = CompanyFinancial::find($this->modelId);

        $this->id = $model->id;
        $this->company_id = $model->company_id;
        $this->phase_id = $model->phase_id;
        $this->total_sanctioned_amount = $model->total_sanctioned_amount;
        $this->total_installments = $model->total_installments;
        $this->installment_markup_percentage = $model->installment_markup_percentage;
        $this->installment_amount = $model->installment_amount;
        $this->is_sanctioned_by_kcbl = $model->is_sanctioned_by_kcbl;
        $this->is_completed_by_kcbl = $model->is_completed_by_kcbl;
    }

    public function save()
    {
        // Data validation
        $validateData = [
            'company_id' => 'required|integer',
            'phase_id' => 'required|integer',
            'total_sanctioned_amount' => 'required|numeric|gte:1',
            'total_installments' => 'required|integer|gte:1',
            'installment_markup_percentage' => 'required|numeric|gte:1',
            'installment_amount' => 'required|numeric|gte:1',
            'is_sanctioned_by_kcbl' => 'required|integer',
            'is_completed_by_kcbl' => 'required|integer'
        ];

        // Default data
        $data = [
            'company_id' => $this->company_id,
            'phase_id' => $this->phase_id,
            'total_sanctioned_amount' => $this->total_sanctioned_amount,
            'total_installments' => $this->total_installments,
            'installment_markup_percentage' => $this->installment_markup_percentage,
            'installment_amount' => $this->installment_amount,
            'is_sanctioned_by_kcbl' => $this->is_sanctioned_by_kcbl,
            'is_completed_by_kcbl' => $this->is_completed_by_kcbl
        ];

        $this->validate($validateData);

        try {
            if ($this->modelId) {
                CompanyFinancial::find($this->modelId)->update($data);
                $postInstanceId = $this->modelId;
            } else {
                $postInstance = CompanyFinancial::create($data);
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
        $this->phase_id = null;
        $this->total_sanctioned_amount = null;
        $this->total_installments = null;
        $this->installment_markup_percentage = null;
        $this->installment_amount = null;
        $this->is_sanctioned_by_kcbl = null;
        $this->is_completed_by_kcbl = null;
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_company_financials";
        $this->card_title = "Company Financials";

        $companies = Company::all();
        $phases = Phase::all();

        return view('livewire.admin.company-financials-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('companies', $companies)
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
