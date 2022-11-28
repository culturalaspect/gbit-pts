<?php

namespace App\Http\Livewire\Admin;

use App\Models\Phase;
use App\Models\Scheme;
use Livewire\Component;

class PhasesIndex extends Component
{
    protected $page_title = "Performance Tracking System | G-Link | Phases";
    protected $main_title = "Phases";
    protected $breadcrumb_title = "Phases";
    protected $selected_main_menu = "admin_phases";
    protected $card_title;
    protected $selected_sub_menu;

    public $action;
    public $selectedItem;

    public $modelId;
    public $phase_name;
    public $scheme_id;
    public $date_from;
    public $date_to;
    public $is_active;

    public $deleteErrorMessage = 'Deleted Record Successfully';


    protected $listeners = [
        'getModelId',
        'hideModal',
        'openModal',
        'closeModal',
        'setDateFrom',
        'setDateTo',
        'refreshParent' => '$refresh',
        'selectItem' => 'selectItem'
    ];

    public function setDateFrom($date) {
        $this->date_from = $date;
    }

    public function setDateTo($date) {
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
        $item = Phase::find($this->selectedItem);

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

        $model = Phase::find($this->modelId);

        $this->phase_name = $model->phase_name;
        $this->scheme_id = $model->scheme_id;
        $this->date_from = $model->date_from;
        $this->date_to = $model->date_to;
        $this->is_active = $model->is_active;
    }

    public function save()
    {
        // Data validation
        $validateData = [
            'phase_name' => 'required|min:3',
            'scheme_id' => 'required|integer',
            'date_from' => 'required|date|date_format:Y-m-d',
            'date_to' => 'required|date|date_format:Y-m-d|after:date_from',
            'is_active' => 'required|integer'
        ];

        // Default data
        $data = [
            'phase_name' => $this->phase_name,
            'scheme_id' => $this->scheme_id,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'is_active' => $this->is_active
        ];

        $this->validate($validateData);

        if($this->is_active) {
            Phase::where('is_active', '=', 1)
                ->update(['is_active' => 0]);
        }

        if ($this->modelId) {

            Phase::find($this->modelId)->update($data);
            $postInstanceId = $this->modelId;
        } else {
            $postInstance = Phase::create($data);
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
        $this->phase_name = null;
        $this->scheme_id = null;
        $this->date_from = null;
        $this->date_to = null;
        $this->is_active = null;
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_phases";
        $this->card_title = "Phases";

        $schemes = Scheme::all();

        return view('livewire.admin.phases-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('schemes', $schemes)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
