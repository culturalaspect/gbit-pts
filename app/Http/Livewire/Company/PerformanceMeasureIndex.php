<?php

namespace App\Http\Livewire\Company;

use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyPerformanceMeasure;
use App\Models\District;
use App\Models\PerformanceMeasure;
use App\Models\Phase;
use App\Models\PmQuestion;
use App\Models\CpmQuestionAnswer;
use Livewire\Component;

use Hash;

class PerformanceMeasureIndex extends Component
{
    protected $page_title = "Performance Tracking System | G-Link | Performance Track";
    protected $main_title = "Performance Track";
    protected $breadcrumb_title = "Performance Track";
    protected $selected_main_menu = "admin_index";
    protected $card_title;
    protected $selected_sub_menu;

    public $cpm;
    public $phase;
    public $measure;
    public $pmquestions;

    public $total_employees;
    public $total_revenue;
    public $total_profit;
    public $total_amount_utilized;

    public $cpm_id;

    public function mount($measure_id, $phase_id) {
        $this->cpm = CompanyPerformanceMeasure::where('company_id', auth()->user()->company_id)->where('measure_id', $measure_id)->where('phase_id', $phase_id)->first();

        if($this->cpm->is_completed == 1) {
            return redirect()->to('company/dashboard')->with('message','Sorry you already have completed the performance survey. Please try again later.');
        }

        $this->phase = Phase::find($phase_id);
        $this->measure = PerformanceMeasure::find($measure_id);
        $this->pmquestions = PmQuestion::where('measure_id', $measure_id)->with('pmquestionoptions')->get();
        $this->cpm_id = $this->cpm->id;
    }

    public function reArrangeFormData($formData):array {
        //dd($formData);

        $tempData = $formData;
        $arranged_array['cpm_id'] = $tempData['cpm_id'];
        unset($tempData['cpm_id']);

        $arranged_array['total_employees'] = $tempData['total_employees'];
        unset($tempData['total_employees']);

        $arranged_array['total_revenue'] = $tempData['total_revenue'];
        unset($tempData['total_revenue']);

        $arranged_array['total_profit'] = $tempData['total_profit'];
        unset($tempData['total_profit']);

        $arranged_array['total_amount_utilized'] = $tempData['total_amount_utilized'];
        unset($tempData['total_amount_utilized']);

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

        $cpm = CompanyPerformanceMeasure::find($cpm_id);
        $cpm->total_employees = $data['total_employees'];
        $cpm->total_employees = $data['total_revenue'];
        $cpm->total_employees = $data['total_profit'];
        $cpm->total_employees = $data['total_amount_utilized'];
        $cpm->is_completed = true;
        $cpm->save();

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

        return redirect()->to('company/dashboard')->with('message','Successfully submitted the performance track survey.');

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
        $company->save();

        $this->dispatchBrowserEvent('showSuccessToast');
        $this->cleanVars();
    }

    private function cleanVars()
    {
        $this->password = null;
        $this->old_password = null;
        $this->confirm_password = null;
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_index";
        $this->card_title = "Performance Track";

        $categories =Category::all();
        $districts =District::all();

        return view('livewire.company.performance-measure-index')
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
