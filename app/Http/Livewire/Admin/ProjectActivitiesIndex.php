<?php

namespace App\Http\Livewire\Admin;

use App\Models\Activity;
use Str;
use App\Models\Phase;
use App\Models\Domain;
use App\Models\Company;
use App\Models\Project;
use Livewire\Component;

use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectActivitiesIndex extends Component
{

    use WithFileUploads;

    protected $page_title = "Performance Tracking System | G-Link | Project Activities";
    protected $main_title = "Project Activities";
    protected $breadcrumb_title = "Project Activities";
    protected $selected_main_menu;
    protected $card_title;
    protected $selected_sub_menu;

    public $action;
    public $selectedItem;

    public $modelId;
    public $project_id;
    public $activity_title;
    public $methodology;
    public $start_date;
    public $end_date;
    public $status;
    public $deliverable;
    public $result;
    public $is_deadline_set;

    public $deleteErrorMessage = 'Deleted Record Successfully';


    protected $listeners = [
        'getModelId',
        'hideModal',
        'openModal',
        'closeModal',
        'setEndDate',
        'setStartDate',
        'updatedSelectedProject',
        'refreshParent' => '$refresh',
        'selectItem' => 'selectItem'
    ];

    public function setStartDate($date) {
        $this->start_date = $date;
    }

    public function setEndDate($date) {
        $this->end_date = $date;
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
        Activity::destroy($this->selectedItem);
        $this->dispatchBrowserEvent('hideDeleteModal');
        $this->emit('pg:eventRefresh-default');
        $this->dispatchBrowserEvent('showErrorToast');
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = Activity::find($this->modelId);

        $this->id = $model->id;
        $this->project_id = $model->project_id;
        $this->methodology = $model->methodology;
        $this->activity_title = $model->activity_title;
        $this->start_date = $model->start_date;
        $this->end_date = $model->end_date;
        $this->status = $model->status;
        //$this->deliverable = $model->deliverable;
        $this->result = $model->result;
        $this->is_deadline_set = $model->is_deadline_set;
    }

    public function save()
    {

        // Data validation
        $validateData = [
            'project_id' => 'required|integer',
            'methodology' => 'nullable|min:3',
            'activity_title' => 'nullable|min:3',
            'start_date' => 'nullable|date|date_format:Y-m-d',
            'end_date' => 'nullable|date|date_format:Y-m-d|after:start_date',
            'status' => 'required|integer',
            'deliverable' => 'nullable|mimes:jgp,jpeg,png,bmp,gif,mp4,mp3,mpeg,doc,docx,pdf,xls,xlsx,csv,zip,rar',
            'result' => 'nullable|min:3',
            'is_deadline_set' => 'required|integer',
        ];

        // Default data
        $data = [
            'project_id' => $this->project_id,
            'methodology' => $this->methodology,
            'activity_title' => $this->activity_title,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            //'deliverable' => $this->deliverable,
            'result' => $this->result,
            'is_deadline_set' => $this->is_deadline_set,
        ];



        $this->validate($validateData);

        try {
            $this->dispatchBrowserEvent('blockUI');

            if (!empty($this->deliverable)) {
                $imageHashName = $this->deliverable->hashName();

                // Append to the validation if image is not empty
                /* $validateData = array_merge($validateData, [
                    'deliverable' => 'image'
                ]); */

                // This is to save the filename of the image in the database
                $data = array_merge($data, [
                    'deliverable' => $imageHashName
                ]);

                // Upload the main image
                $this->deliverable->store('public/deliverables');
                /* Storage::makeDirectory('public/deliverables');

                // Create a thumbnail of the image using Intervention Image Library
                $manager = new ImageManager();
                $image = $manager->make('storage/photos/'.$imageHashName)->resize(300, 200);
                $image->save('storage/deliverables/'.$imageHashName);

                File::create(); */
            }

            if ($this->modelId) {
                Activity::find($this->modelId)->update($data);
                $postInstanceId = $this->modelId;
            } else {
                $postInstance = Activity::create($data);
                //$postInstanceId = $postInstance->id;
            }

            $this->emit('refreshParent');
            $this->emit('pg:eventRefresh-default');
            $this->dispatchBrowserEvent('showSuccessToast');
            $this->dispatchBrowserEvent('hideModal');
            $this->cleanVars();
            $this->dispatchBrowserEvent('unblockUI');

        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->errorInfo);
            if($e->getCode()==23000) {
                $this->dispatchBrowserEvent('hideDeleteModal');
                $this->emit('pg:eventRefresh-default');
                $this->deleteErrorMessage = 'Integrity Constraint Violation! A record with same entry already exists. Please check your entries and try again later.';
                $this->dispatchBrowserEvent('showErrorToast');
                $this->dispatchBrowserEvent('unblockUI');

            } else {
                $this->dispatchBrowserEvent('hideDeleteModal');
                $this->emit('pg:eventRefresh-default');
                $this->deleteErrorMessage = 'Something Went Wrong! Please Try Again Later.';
                $this->dispatchBrowserEvent('showErrorToast');
                $this->dispatchBrowserEvent('unblockUI');
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
        $this->project_id = null;
        $this->activity_title = null;
        $this->methodology = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->status = null;
        $this->deliverable = null;
        $this->result = null;
        $this->is_deadline_set = null;
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_projects_activities";
        $this->card_title = "Project Activities";

        $projects = Project::all();

        return view('livewire.admin.project-activities-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('projects', $projects)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
