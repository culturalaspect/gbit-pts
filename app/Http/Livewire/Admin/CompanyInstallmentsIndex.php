<?php

namespace App\Http\Livewire\Admin;

use App\Models\Company;
use App\Models\CompanyFinancial;
use App\Models\CompanyInstallment;
use App\Models\Phase;
use Livewire\Component;

class CompanyInstallmentsIndex extends Component
{
    protected $page_title = "Performance Monitoring Information System | G-Link | Company Installments";
    protected $main_title = "Company Installments";
    protected $breadcrumb_title = "Company Installments";
    protected $selected_main_menu;
    protected $card_title;
    protected $selected_sub_menu;

    public $action;
    public $selectedItem;

    public $modelId;
    public $company_id;
    public $installment_no;
    public $amount_paid;
    public $date_of_payment;
    public $company_name;
    public $phase_id;
    public $companies;
    public $phases;

    public $deleteErrorMessage = 'Deleted Record Successfully';


    protected $listeners = [
        'getModelId',
        'hideModal',
        'openModal',
        'closeModal',
        'setDataForCompany',
        'setDate',
        'updatedSelectedPhase',
        'refreshParent' => '$refresh',
        'selectItem' => 'selectItem'
    ];

    public function setDataForCompany() {
        if(!is_null(($this->company_id) && $this->company_id != "") && (!is_null($this->phase_id) && $this->phase_id != "")) {
            $this->dispatchBrowserEvent('blockUI');
            $companyfinancial = CompanyFinancial::where('company_id', $this->company_id)->where('phase_id', $this->phase_id)->first();

            $installment = CompanyInstallment::where('company_id', $this->company_id)->where('phase_id', $this->phase_id)->orderBy('installment_no', 'DESC')->first();
            if($installment) {
                if(!$this->modelId) {
                    $this->installment_no = $installment->installment_no + 1;
                } else {
                    $cmp_i = CompanyInstallment::find($this->modelId);
                    if($cmp_i->company_id == $this->company_id && $cmp_i->phase_id == $this->phase_id) {
                        $this->installment_no = $cmp_i->installment_no;
                    } else {
                        if($installment) {
                            $this->installment_no = $installment->installment_no + 1;
                        }
                    }
                }
            } else {
                $this->installment_no = 1;
            }

            if($companyfinancial) {
                $this->amount_paid = $companyfinancial->installment_amount;
                $this->date_of_payment = date('Y-m-d');
            } else {
                $this->amount_paid = null;
                $this->date_of_payment = date('Y-m-d');
            }
            $this->dispatchBrowserEvent('unblockUI');
        }
    }

    public function setDate($date) {
        $this->date_of_payment = $date;
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
        $item = CompanyInstallment::find($this->selectedItem);

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

        $model = CompanyInstallment::find($this->modelId);

        $this->phases = Phase::join('company_financials', 'company_financials.phase_id', '=', 'phases.id')->where('company_financials.company_id', $model->company_id)->get(['phases.id', 'phases.phase_name']);

        $this->modelId = $model->id;
        $this->company_id = $model->company_id;
        $this->installment_no = $model->installment_no;
        $this->amount_paid = $model->amount_paid;
        $this->date_of_payment = $model->date_of_payment;
        $this->company_name = $model->company_name;
        $this->phase_id = $model->phase_id;
    }

    public function save()
    {
        // Data validation
        $validateData = [
            'company_id' => 'required|integer',
            'installment_no' => 'required|numeric|gte:1',
            'amount_paid' => 'required|numeric|gte:1',
            'date_of_payment' => 'required|date|date_format:Y-m-d',
            'phase_id' => 'required|integer'
        ];

        // Default data
        $data = [
            'company_id' => $this->company_id,
            'installment_no' => $this->installment_no,
            'amount_paid' => $this->amount_paid,
            'date_of_payment' => $this->date_of_payment,
            'phase_id' => $this->phase_id
        ];

        $this->validate($validateData);

        try {
            if ($this->modelId) {
                CompanyInstallment::find($this->modelId)->update($data);
                $postInstanceId = $this->modelId;
            } else {
                $postInstance = CompanyInstallment::create($data);
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
        $this->installment_no = null;
        $this->amount_paid = null;
        $this->date_of_payment = null;
        $this->company_name = null;
        $this->phase_id = null;
        $this->phases = null;
    }

    public function updatedSelectedPhase()
    {
        $this->dispatchBrowserEvent('blockUI');
        if (!is_null($this->company_id)) {
            $this->phases = Phase::join('company_financials', 'company_financials.phase_id', '=', 'phases.id')->where('company_financials.company_id', $this->company_id)->get(['phases.id', 'phases.phase_name']);
        }
        $this->dispatchBrowserEvent('unblockUI');
    }

    public function mount()
    {
        $this->companies = Company::join('company_financials', 'company_financials.company_id', '=', 'companies.id')->where('company_financials.is_sanctioned_by_kcbl', 1)->get();
        $this->phases = collect();
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_company_installments";
        $this->card_title = "Company Installments";

        // $companies = Company::join('company_financials', 'company_financials.company_id', '=', 'companies.id')->where('company_financials.is_sanctioned_by_kcbl', 1)->get();
        // $phases = Phase::all();

        return view('livewire.admin.company-installments-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('companies', $this->companies)
                ->with('phases', $this->phases)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
