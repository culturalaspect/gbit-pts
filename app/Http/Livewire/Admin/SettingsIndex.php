<?php

namespace App\Http\Livewire\Admin;

use App\Models\District;
use App\Models\User;
use Livewire\Component;

use Hash;

class SettingsIndex extends Component
{
    protected $page_title = "Performance Monitoring Information System | G-Link | Settings";
    protected $main_title = "Settings";
    protected $breadcrumb_title = "Settings";
    protected $selected_main_menu = "admin_settings";
    protected $card_title;
    protected $selected_sub_menu;

    public $user;
    public $old_password;
    public $password;
    public $confirm_password;

    public function mount() {
        $this->user = User::find(auth()->user()->id);
    }

    public function save()
    {
        // Data validation
        $user = $this->user;
        $validateData = [
            'password' => [
                'required',
                'string',
                'different:old_password',
                'min:8',             // must be at least 8 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[0-9]/',      // must contain at least one digit
            ],
            'old_password' => [
                'required',

                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('Your old password does not match.');
                    }
                }
            ],
            'confirm_password' => 'required|min:8|same:password'
        ];

        $this->validate($validateData);

        $user->password = Hash::make($this->password);
        $user->save();

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
        $this->selected_sub_menu = "admin_settings";
        $this->card_title = "Settings";

        $owners = User::all();

        return view('livewire.admin.settings-index')
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
