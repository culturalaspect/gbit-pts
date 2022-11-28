<?php

namespace App\Http\Livewire\Admin;

use App\Models\PerformanceMeasure;
use App\Models\PmQuestion;
use App\Models\PmQuestionOption;
use Dotenv\Validator;
use Livewire\Component;

class PerformanceMeasuresIndex extends Component
{
    protected $page_title = "Performance Tracking System | G-Link | Performance Measures";
    protected $main_title = "Performance Measures";
    protected $breadcrumb_title = "Performance Measures";
    protected $selected_main_menu = "admin_performance_measures";
    protected $card_title;
    protected $selected_sub_menu;

    public $action;
    public $selectedItem;

    public $modelId;
    public $measure_name;
    public $description;
    public $date_from;
    public $date_to;
    public $is_active;

    public $questions = array();
    public $isOptBtnDisabled = array();
    //public $qOptions;

    public $deleteErrorMessage = 'Deleted Record Successfully';


    protected $listeners = [
        'getModelId',
        'hideModal',
        'openModal',
        'closeModal',
        'setDateFrom',
        'setDateTo',
        'addQuestion',
        'deleteQuestion',
        'saveQuestion',
        'showOptions',
        'addOption',
        'deleteOption',
        'refreshParent' => '$refresh',
        'selectItem' => 'selectItem'
    ];

    // protected $rules = [
    //     'measure_name' => 'required|min:3',
    //     'description' => 'nullable|min:3',
    //     'date_from' => 'required|date|date_format:Y-m-d',
    //     'date_to' => 'required|date|date_format:Y-m-d|after:date_from',
    //     'is_active' => 'required|integer',
    //     'questions.*.question.question' => 'required|min:3',
    //     'questions.*.question.question_type' => 'required|integer',
    //     'questions.*.question.is_required' => 'required|integer',
    //     'questions.*.options.*.option_text' => 'required'
    // ];

    public function mount()
    {
        $q_array = array();

        $q_array['question'] = array();
        $q_array['options'] = array();
        array_push($this->questions, $q_array);
        $is_disabled_arr['is_disabled'] = true;
        array_push($this->isOptBtnDisabled, $is_disabled_arr);
    }

    public function addQuestion()
    {
        $new_array = array();
        $new_array['question'] = [];
        $new_array['options'] = [];
        array_push($this->questions, $new_array);
        $is_disabled_arr['is_disabled'] = true;
        array_push($this->isOptBtnDisabled, $is_disabled_arr);
        /* if($this->questions) {
            dd($this->questions);
            $new_array = array();
            $new_array[]['question'] = [];
            $new_array[]['options'] = [];
            array_push($this->questions, $new_array);
            array_push($this->questions[end($this->questions['question'])]['question'], new PmQuestion());
            $this->questions[end($this->questions)]['question']->push(new PmQuestion());
            array_push($this->questions['question'], new PmQuestion());
            $this->questions[end($this->questions)]['options']->push(new PmQuestionOption());
            array_push($this->questions['options'], new PmQuestionOption());
        } */
    }

    public function deleteQuestion($index){
        unset($this->questions[$index]);
        unset($this->isOptBtnDisabled[$index]);
    }

    public function addOption($index)
    {
        //$this->questions[$index]['options']->push(new PmQuestionOption());
        array_push($this->questions[$index]['options'], new PmQuestionOption());
        // $question = $this->questions[$index];
        // $this->qOptions->push(new PmQuestionOption());
        // $this->questions[$index]['qOptions']= $this->qOptions;
    }

    public function deleteOption($index, $indx) {
        unset($this->questions[$index]['options'][$indx]);
    }

    public function showOptions($value, $index)
    {
        if($value == 1 || $value == 2) {
            $this->isOptBtnDisabled[$index]['is_disabled'] = false;
        } else {
            $this->isOptBtnDisabled[$index]['is_disabled'] = true;
        }

        $this->questions[$index]['options'] = [];
    }

    // public function saveQuestion()
    // {
    //     $validateData = [
    //         'measure_name' => 'required|min:3',
    //         'description' => 'nullable|min:3',
    //         'date_from' => 'required|date|date_format:Y-m-d',
    //         'date_to' => 'required|date|date_format:Y-m-d|after:date_from',
    //         'is_active' => 'required|integer',
    //         'questions.*.question' => 'required|min:3',
    //         'questions.*.question_type' => 'required|integer',
    //         'questions.*.is_required' => 'required|integer',
    //         'questions.*.options.*.option_text' => 'required'
    //     ];

    //     $customMessages = [
    //         'measure_name.required' => 'This field is required.',
    //         'measure_name.min' => 'Please enter at least 3 characters in this field.',
    //         'questions.*.question.required' => 'This field is required',
    //         'questions.*.question.min' => 'Please enter at least 3 characters in this field.',
    //         'questions.*.question_type.required' => 'This field is required.',
    //         'questions.*.question_type.integer' => 'This field must be an integer.',
    //         'questions.*.is_required.required' => 'This field is required.',
    //         'questions.*.is_required.integer' => 'This field must be an integer.',
    //         'questions.*.options.*.option_text.required' => 'This field is required.',
    //     ];



    //     $this->validate($validateData, $customMessages);

    // }



    public function setDateFrom($date)
    {
        $this->date_from = $date;
    }

    public function setDateTo($date)
    {
        $this->date_to = $date;
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
        $item = PerformanceMeasure::find($this->selectedItem);

        if ($item) {
            try {
                $pmqs = PmQuestion::where('measure_id', $item->id)->get();
                foreach($pmqs as $q) {
                    $q->pmquestionoptions()->delete();
                    $q->delete();
                }
                $item->delete();
                $this->dispatchBrowserEvent('hideDeleteModal');
                $this->emit('pg:eventRefresh-default');
                $this->deleteErrorMessage = 'Record Deleted Successfully';
                $this->dispatchBrowserEvent('showErrorToast');
            } catch (\Illuminate\Database\QueryException $e) {
                //var_dump($e->errorInfo);
                if ($e->getCode() == 23000) {
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

        $model = PerformanceMeasure::find($this->modelId);

        $this->measure_name = $model->measure_name;
        $this->description = $model->description;
        $this->date_from = $model->date_from;
        $this->date_to = $model->date_to;
        $this->is_active = $model->is_active;

        $this->questions = (array)null;
        $this->isOptBtnDisabled = (array)null;

        $pmquestions = PmQuestion::with('pmquestionoptions')->where('measure_id', $this->modelId)->get();
        //dd($pmquestions);

        $is_disabled_arr['is_disabled'] = array();


        $q_array = array();
        $i=0;
        if(count($pmquestions)>0) {
            foreach($pmquestions as $question) {
                $q_array['question'] = $question;

                if($question->question_type == 1 || $question->question_type == 2) {
                    $is_disabled_arr['is_disabled'] = false;
                    array_push($this->isOptBtnDisabled, $is_disabled_arr);
                } else {
                    $is_disabled_arr['is_disabled'] = true;
                    array_push($this->isOptBtnDisabled, $is_disabled_arr);
                }

                $q_array['options'] = $question->pmquestionoptions;
                $i++;

                array_push($this->questions, $q_array);
            }
        } else {
            $q_array['question'] = array();
            $q_array['options'] = array();
            $is_disabled_arr['is_disabled'] = true;
            array_push($this->isOptBtnDisabled, $is_disabled_arr);

            array_push($this->questions, $q_array);
        }

        //dd($this->isOptBtnDisabled);
    }

    public function save()
    {
        // Data validation
        $validateData = [
            'measure_name' => 'required|min:3',
            'description' => 'nullable|min:3',
            'date_from' => 'required|date|date_format:Y-m-d',
            'date_to' => 'required|date|date_format:Y-m-d|after:date_from',
            'is_active' => 'required|integer',
            'questions.*.question.question' => 'required|min:3',
            'questions.*.question.question_type' => 'required|integer',
            'questions.*.question.is_required' => 'required|integer',
            'questions.*.options.*.option_text' => 'required'
        ];

        $customMessages = [
            'measure_name.required' => 'This field is required.',
            'measure_name.min' => 'Please enter at least 3 characters in this field.',
            'questions.*.question.question.required' => 'This field is required',
            'questions.*.question.question.min' => 'Please enter at least 3 characters in this field.',
            'questions.*.question.question_type.required' => 'This field is required.',
            'questions.*.question.question_type.integer' => 'This field must be an integer.',
            'questions.*.question.is_required.required' => 'This field is required.',
            'questions.*.question.is_required.integer' => 'This field must be an integer.',
            'questions.*.options.*.option_text.required' => 'This field is required.',
        ];

        $pm_data = [
            'measure_name' => $this->measure_name,
            'description' => $this->description,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'is_active' => $this->is_active
        ];

        //dd($this->questions);

        $this->validate($validateData, $customMessages);

        // Default data


        if ($this->is_active) {
            PerformanceMeasure::where('is_active', '=', 1)
                ->update(['is_active' => 0]);
        }

        //dd($this->questions);

        if ($this->modelId) {
            $p_measure = PerformanceMeasure::find($this->modelId)->update($pm_data);
            $postInstanceId = $this->modelId;
            $p_measure = PerformanceMeasure::find($this->modelId);
        } else {
            $p_measure = PerformanceMeasure::create($pm_data);
            $postInstanceId = $p_measure->id;
            $p_measure = PerformanceMeasure::find($postInstanceId);
        }

        //dd($this->questions);

        $pmqs = PmQuestion::where('measure_id', $p_measure->id)->get();
        foreach($pmqs as $q) {
            $q->pmquestionoptions()->delete();
            $q->delete();
        }

        foreach($this->questions as $question) {
            //dd($question);
            $pm_question = new PmQuestion();
            $pm_question->question = $question['question']['question'];
            $pm_question->question_type = $question['question']['question_type'];
            $pm_question->is_required = $question['question']['is_required'];
            $pm_question->measure()->associate($p_measure);
            $pm_question->save();

            if(count($question['options']) > 0) {
                foreach($question['options'] as $option) {
                    $pm_question_option = new PmQuestionOption();
                    $pm_question_option->option_text = $option['option_text'];
                    $pm_question_option->pmquestion()->associate($pm_question);
                    $pm_question_option->save();
                }
            }
        }

        //$this->dispatchBrowserEvent('showLoader');
        $this->emit('refreshParent');
        $this->emit('pg:eventRefresh-default');
        $this->dispatchBrowserEvent('showSuccessToast');
        $this->dispatchBrowserEvent('hideModal');
        $this->cleanVars();
        //$this->dispatchBrowserEvent('hideLoader');
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
        $this->measure_name = null;
        $this->description = null;
        $this->date_from = null;
        $this->date_to = null;
        $this->is_active = null;
        $this->questions = (array)null;
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_performance_measures";
        $this->card_title = "Performance Measures";

        return view('livewire.admin.performance-measures-index')
            ->with('main_title', $this->main_title)
            ->with('breadcrumb_title', $this->breadcrumb_title)
            ->with('card_title', $this->card_title)
            ->layout(
                'livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
