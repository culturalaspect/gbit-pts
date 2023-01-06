<?php

namespace App\Http\Livewire\Admin;

use App\Models\Company;
use App\Models\Phase;
use App\Models\CompanyPerformanceMeasure;
use App\Models\CpmQuestionAnswer;
use App\Models\PerformanceMeasure;
use App\Models\PmQuestion;
use Livewire\Component;

class CompanyPerformanceMeasuresIndex extends Component
{
    protected $page_title = "Performance Monitoring Information System | G-Link | Company Performance Measures";
    protected $main_title = "Company Performance Measures";
    protected $breadcrumb_title = "Company Performance Measures";
    protected $selected_main_menu;
    protected $card_title;
    protected $selected_sub_menu;

    public $action;
    public $selectedItem;

    public $modelId;
    public $company_id;
    public $measure_id;
    public $total_employees;
    public $total_revenue;
    public $total_profit;
    public $total_amount_utilized;
    public $is_completed;

    public $companies;
    public $phases;

    public $pmquestions;
    public $cpm_id;

    public $deleteErrorMessage = 'Deleted Record Successfully';


    protected $listeners = [
        'getModelId',
        'hideModal',
        'openModal',
        'closeModal',
        'setDataForCompany',
        'updatedSelectedPhase',
        'updatePerformanceQuestions',
        'refreshParent' => '$refresh',
        'selectItem' => 'selectItem'
    ];

    public function reArrangeFormData($formData):array {
        //dd($formData);

        $tempData = $formData;
        $arranged_array['cpm_id'] = $tempData['cpm_id'];
        unset($tempData['cpm_id']);

        //dd($tempData);
        foreach($tempData as $key => $data) {
            //dd($key);
            $new_key = str_replace('[', '.', $key);
            $new_key = str_replace(']', '.', $new_key);
            $new_key = str_replace('..', '.', $new_key);
            $new_key = rtrim($new_key, ".");
            $exp_arr = explode('.', $new_key);
            //dd($exp_arr);
            if(count($exp_arr) == 2) {
                $arranged_array['answers'][$exp_arr[1]][$exp_arr[0]] = $data;
            } elseif (count($exp_arr) == 3) {
                $arranged_array['answers'][$exp_arr[1]]['value'] = $data;
            } else {
                $arranged_array['answers'][$exp_arr[1]]['options'][$exp_arr[3]] = $data;
            }

            //$arranged_array['answers'][$new_key] = $data;
        }

        return $arranged_array;
    }

    public function submit($formData){
        $data = $this->reArrangeFormData($formData);
        $cpm_id = $data['cpm_id'];

        //dd($data);

        CpmQuestionAnswer::where('cpm_id', $cpm_id)->delete();

        foreach($data['answers'] as $answer) {
            if($answer['field_type'] == 2) {
                if(isset($answer['options'])) {
                    if(count($answer['options']) > 0){
                        foreach($answer['options'] as $option) {
                            $cpm_qa = new CpmQuestionAnswer();
                            $cpm_qa->cpm_id = $cpm_id;
                            $cpm_qa->pm_question_id = $answer['question_id'];
                            $cpm_qa->pm_answer = $option;
                            $cpm_qa->save();
                        }
                    }
                }
            } else {
                $cpm_qa = new CpmQuestionAnswer();
                $cpm_qa->cpm_id = $cpm_id;
                $cpm_qa->pm_question_id = $answer['question_id'];
                $cpm_qa->pm_answer = $answer['value'];
                $cpm_qa->save();
            }
        }

        $this->emit('pg:eventRefresh-default');
        $this->dispatchBrowserEvent('showSuccessToast');
        $this->dispatchBrowserEvent('hideQuestionsModal');

    }

    public function updatePerformanceQuestions($id) {
        $cpm = CompanyPerformanceMeasure::where('id', $id)->first();
        //dd($cpm);
        $pmq = PmQuestion::where('measure_id', $cpm->measure_id)->with('pmquestionoptions')->get();
        $cpmqa = CpmQuestionAnswer::where('cpm_id', $cpm->id)->get();
        //dd($cpmqa);
        //dd($pmq);
        $this->pmquestions = $pmq;
        $this->cpm_id = $cpm->id;
        //dd($this->pmquestions);
        $this->dispatchBrowserEvent('showQuestionsModal');
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
        $item = CompanyPerformanceMeasure::find($this->selectedItem);

        if($item){
            try {
                CpmQuestionAnswer::where('cpm_id', $this->selectedItem)->delete();
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

        $model = CompanyPerformanceMeasure::find($this->modelId);

        $this->phases = Phase::join('company_financials', 'company_financials.phase_id', '=', 'phases.id')->where('company_financials.company_id', $model->company_id)->get(['phases.id', 'phases.phase_name']);

        $this->modelId = $model->id;
        $this->company_id = $model->company_id;
        $this->measure_id = $model->measure_id;
        $this->total_employees = $model->total_employees;
        $this->total_revenue = $model->total_revenue;
        $this->total_profit = $model->total_profit;
        $this->total_amount_utilized = $model->total_amount_utilized;
        $this->is_completed = $model->is_completed;
        $this->phase_id = $model->phase_id;
    }

    public function save()
    {
        // Data validation
        $validateData = [
            'company_id' => 'required|integer',
            'measure_id' => 'required|integer',
            'total_employees' => 'nullable|integer|gte:1',
            'total_revenue' => 'nullable|numeric|gte:1',
            'total_profit' => 'nullable|numeric|gte:1',
            'total_amount_utilized' => 'nullable|numeric|gte:1',
            'is_completed' => 'required|integer',
            'phase_id' => 'required|integer'
        ];

        // Default data
        $data = [
            'company_id' => $this->company_id,
            'measure_id' => $this->measure_id,
            'total_employees' => $this->total_employees,
            'total_revenue' => $this->total_revenue,
            'total_profit' => $this->total_profit,
            'total_amount_utilized' => $this->total_amount_utilized,
            'is_completed' => $this->is_completed,
            'phase_id' => $this->phase_id
        ];

        $this->validate($validateData);

        if ($this->modelId) {
            CompanyPerformanceMeasure::find($this->modelId)->update($data);
            $postInstanceId = $this->modelId;
        } else {
            $postInstance = CompanyPerformanceMeasure::create($data);
            //$postInstanceId = $postInstance->id;
        }

        $this->emit('refreshParent');
        $this->emit('pg:eventRefresh-default');
        $this->dispatchBrowserEvent('showSuccessToast');
        $this->dispatchBrowserEvent('hideModal');
        $this->cleanVars();
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
        $this->measure_id = null;
        $this->total_employees = null;
        $this->total_revenue = null;
        $this->total_profit = null;
        $this->total_amount_utilized = null;
        $this->is_completed = null;
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
        $this->selected_sub_menu = "admin_company_performance_measures";
        $this->card_title = "Company Performance Measures";

        $companies = Company::join('company_financials', 'company_financials.company_id', '=', 'companies.id')->where('company_financials.is_sanctioned_by_kcbl', 1)->get(['companies.id', 'companies.company_name']);
        $measures = PerformanceMeasure::all();

        return view('livewire.admin.company-performance-measures-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('companies', $this->companies)
                ->with('phases', $this->phases)
                ->with('measures', $measures)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
