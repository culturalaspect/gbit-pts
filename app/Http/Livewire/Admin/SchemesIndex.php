<?php

namespace App\Http\Livewire\Admin;

use App\Models\Scheme;
use App\Models\User;
use Livewire\Component;

class SchemesIndex extends Component
{
    protected $page_title = "Performance Monitoring Information System | G-Link | Schemes";
    protected $main_title = "Schemes";
    protected $breadcrumb_title = "Schemes";
    protected $selected_main_menu = "admin_schemes";
    protected $card_title;
    protected $selected_sub_menu;

    public $action;
    public $selectedItem;

    public $modelId;
    public $scheme_name;
    public $sanctioned_amount;
    public $date_of_sanction;
    public $description;

    public $deleteErrorMessage = 'Deleted Record Successfully';


    protected $listeners = [
        'getModelId',
        'hideModal',
        'openModal',
        'closeModal',
        'setDate',
        'refreshParent' => '$refresh',
        'selectItem' => 'selectItem'
    ];

    public function setDate($date) {
        $this->date_of_sanction = $date;
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
        $item = Scheme::find($this->selectedItem);

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

        $model = Scheme::find($this->modelId);

        $this->scheme_name = $model->scheme_name;
        $this->sanctioned_amount = $model->sanctioned_amount;
        $this->date_of_sanction = $model->date_of_sanction;
        $this->description = $model->description;
    }

    public function save()
    {
        // Data validation
        $validateData = [
            'scheme_name' => 'required|min:3',
            'sanctioned_amount' => 'required|numeric|gte:0',
            'date_of_sanction' => 'required|date|date_format:Y-m-d',
            'description' => 'nullable|min:3'
        ];

        // Default data
        $data = [
            'scheme_name' => $this->scheme_name,
            'sanctioned_amount' => $this->sanctioned_amount,
            'date_of_sanction' => $this->date_of_sanction,
            'description' => $this->description,
        ];

        $this->validate($validateData);

        if ($this->modelId) {
            Scheme::find($this->modelId)->update($data);
            $postInstanceId = $this->modelId;
        } else {
            $postInstance = Scheme::create($data);
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
        $this->scheme_name = null;
        $this->sanctioned_amount = null;
        $this->date_of_sanction = null;
        $this->description = null;
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_schemes";
        $this->card_title = "Schemes";

        $owners = User::all();

        return view('livewire.admin.schemes-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('owners', $owners)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
