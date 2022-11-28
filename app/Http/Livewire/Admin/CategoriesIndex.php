<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\User;
use Livewire\Component;

class CategoriesIndex extends Component
{
    protected $page_title = "Performance Tracking System | G-Link | Categories";
    protected $main_title = "Categories";
    protected $breadcrumb_title = "Categories";
    protected $selected_main_menu = "admin_categories";
    protected $card_title;
    protected $selected_sub_menu;

    public $action;
    public $selectedItem;

    public $modelId;
    public $category_name;
    public $description;

    public $deleteErrorMessage = 'Deleted Record Successfully';

    protected $listeners = [
        'getModelId',
        'hideModal',
        'openModal',
        'closeModal',
        'refreshParent' => '$refresh',
        'selectItem' => 'selectItem'
    ];

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

        $item = Category::find($this->selectedItem);

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

        $model = Category::find($this->modelId);

        $this->category_name = $model->category_name;
        $this->description = $model->description;
    }

    public function save()
    {
        // Data validation
        $validateData = [
            'category_name' => 'required|min:3',
            'description' => 'nullable|min:3'
        ];

        // Default data
        $data = [
            'category_name' => $this->category_name,
            'description' => $this->description,
        ];

        $this->validate($validateData);

        if ($this->modelId) {
            Category::find($this->modelId)->update($data);
            $postInstanceId = $this->modelId;
        } else {
            $postInstance = Category::create($data);
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
        $this->category_name = null;
        $this->description = null;
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_categories";
        $this->card_title = "Categories";

        $owners = User::all();

        return view('livewire.admin.categories-index')
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
