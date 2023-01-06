<?php

namespace App\Http\Livewire\Admin;

use App\Models\Company;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UsersIndex extends Component
{
    protected $page_title = "Performance Monitoring Information System | G-Link | Users Managment";
    protected $main_title = "Users Managment";
    protected $breadcrumb_title = "Users Managment";
    protected $selected_main_menu = "admin_users";
    protected $card_title;
    protected $selected_sub_menu;

    public $action;
    public $selectedItem;

    public $modelId;
    public $user_name;
    public $role_id ="";
    public $email;
    public $password;
    public $confirm_password;
    public $company_id ="";

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
        $item = User::find($this->selectedItem);

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

        $model = User::find($this->modelId);

        $this->user_name = $model->user_name;
        $this->role_id = $model->role_id;
        $this->email = $model->email;
        $this->password = "";
        $this->confirm_password = "";
        $this->company_id = $model->company_id;
    }

    public function save()
    {
        // Data validation
        $validateData = [
            'user_name' => 'required|min:3',
            'role_id' => 'required|integer',
            'email' => 'required|email|unique:users,email,'.$this->modelId,
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 8 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[0-9]/',      // must contain at least one digit
            ],
            'confirm_password' => 'required|min:8|same:password',
            'company_id' => 'nullable|integer',
        ];

        // Default data
        $data = [
            'user_name' => $this->user_name,
            'role_id' => $this->role_id,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'company_id' => $this->company_id,
        ];

        $this->validate($validateData);

        if ($this->modelId) {
            User::find($this->modelId)->update($data);
            $postInstanceId = $this->modelId;
        } else {
            $postInstance = User::create($data);
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
        $this->user_name = null;
        $this->role_id = null;
        $this->email = null;
        $this->password = null;
        $this->confirm_password = null;
        $this->company_id = null;
    }

    public function render()
    {
        $this->selected_sub_menu = "admin_users";
        $this->card_title = "Users Managment";

        $roles = Role::all();
        $companies = Company::all();

        return view('livewire.admin.users-index')
                ->with('main_title', $this->main_title)
                ->with('breadcrumb_title', $this->breadcrumb_title)
                ->with('card_title', $this->card_title)
                ->with('roles', $roles)
                ->with('companies', $companies)
                ->layout('livewire.app-layout',
                [
                    'selected_main_menu' => $this->selected_main_menu,
                    'selected_sub_menu' => $this->selected_sub_menu,
                    'page_title' => $this->page_title
                ]
            );
    }
}
