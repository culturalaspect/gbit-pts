<?php

namespace App\Http\Livewire\Company;

use Hash;
use App\Models\User;
use App\Models\Company;
use App\Models\Project;
use Livewire\Component;
use App\Models\Activity;
use App\Models\Category;

use App\Models\District;
use Livewire\WithFileUploads;

class ActivityUpdateIndex extends Component
{

    use WithFileUploads;

    protected $page_title = "Performance Monitoring Information System | G-Link | Activities";
    protected $main_title = "Activities";
    protected $breadcrumb_title = "Activities";
    protected $selected_main_menu = "admin_project_activities";
    protected $card_title;
    protected $selected_sub_menu;

    //public $company;
    public $activity;
    public $activity_title;
    public $methodology;
    public $start_date;
    public $end_date;
    public $status;
    public $deliverable;
    public $result;

    public $is_completed;

    public $is_deadline_set;

    public $is_deadline_over = false;

    protected $listeners = [
        'setEndDate',
        'setStartDate'
    ];

    public function setStartDate($date) {
        $this->start_date = $date;
    }

    public function setEndDate($date) {
        $this->end_date = $date;
    }

    public function mount($activity_id) {
        $this->activity = Activity::find($activity_id);

        //dd(date('Y-m-d', strtotime($this->activity->end_date)), date('Y-m-d'));

        if($this->activity->is_deadline_set) {
            if($this->activity->end_date < date('Y-m-d'))
            {
                $this->is_deadline_over = true;
            }
        }

        $this->activity_title = $this->activity->activity_title;
        $this->methodology = $this->activity->methodology;
        $this->start_date = $this->activity->start_date;
        $this->end_date = $this->activity->end_date;
        $this->status = $this->activity->status;
        $this->deliverable = $this->activity->deliverable;
        $this->result = $this->activity->result;
        $this->is_deadline_set = $this->activity->is_deadline_set;
    }

    public function save()
    {
        $actvty = Activity::find($this->activity->id);

        if($actvty->is_deadline_set) {
            if($this->status == 1) {
                $validateData = [
                    'status' => 'required|integer',
                    'deliverable' => 'required|mimes:jgp,jpeg,png,bmp,gif,mp4,mp3,mpeg,doc,docx,pdf,xls,xlsx,csv,zip,rar,wmv,wav,ppt,pptx',
                    'result' => 'required|min:3'
                ];
            } else {
                $validateData = [
                    'status' => 'required|integer'
                ];
            }

        } else {
            if($this->status == 1) {
                $validateData = [
                    'methodology' => 'required|min:3',
                    'start_date' => 'required|date|date_format:Y-m-d',
                    'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
                    'status' => 'required|integer',
                    'deliverable' => 'required|mimes:jgp,jpeg,png,bmp,gif,mp4,mp3,mpeg,doc,docx,pdf,xls,xlsx,csv,zip,rar,wmv,wav,ppt,pptx',
                    'result' => 'required|min:3'
                ];
            } elseif($this->status == 2) {
                $validateData = [
                    'status' => 'required|integer'
                ];
            } else {
                $validateData = [
                    'methodology' => 'required|min:3',
                    'start_date' => 'required|date|date_format:Y-m-d',
                    'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
                    'status' => 'required|integer',
                    'deliverable' => 'nullable|mimes:jgp,jpeg,png,bmp,gif,mp4,mp3,mpeg,doc,docx,pdf,xls,xlsx,csv,zip,rar,wmv,wav,ppt,pptx',
                    'result' => 'nullable|min:3'
                ];
            }

        }



        $this->validate($validateData);

        if (!empty($this->deliverable)) {
            $imageHashName = $this->deliverable->hashName();

            // This is to save the filename of the image in the database
            $actvty->deliverable = $imageHashName;

            // Upload the main image
            $this->deliverable->store('deliverables', ['disk' => 'public_uploads']);
        }

        $actvty->methodology = $this->methodology;
        $actvty->start_date = $this->start_date;
        $actvty->end_date = $this->end_date;
        $actvty->result = $this->result;
        $actvty->status = $this->status;


        if($this->start_date && $this->end_date) {
            $actvty->is_deadline_set = 1;
        }

        $actvty->save();

        $this->dispatchBrowserEvent('showSuccessToast');
        $this->cleanVars();
        return redirect()->to('company/dashboard')->with('message','Successfully Updated Activity.');
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
        $this->card_title = "Activities";

        return view('livewire.company.activities-update-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
