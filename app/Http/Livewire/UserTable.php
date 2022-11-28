<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

use DB;

final class UserTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public string $primaryKey = 'users.id';

    public string $sortField = 'users.id';

    public function header(): array
    {
        return [
            Button::add('add-new')
                ->caption(__('Add New'))
                ->class('btn btn-success btn-lg')
                ->emit('openModal', [])

        ];
    }

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Header::make()->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\User>
    */
    public function datasource(): Builder
    {
        return User::query()
            ->join('roles', function ($roles) {
                $roles->on('users.role_id', '=', 'roles.id');
            })
            ->leftJoin('companies', function($companies) {
                $companies->on('users.company_id', '=', 'companies.id');
            })
            ->select([
                'users.id',
                'users.user_name',
                'roles.role_name as role_name',
                'companies.id as company_id',
                'companies.company_name as company_name',
                'users.email',
                'users.created_at',
                'users.updated_at',
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'role' => [ // relationship on dishes model
                'role_name', // column enabled to search
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            //->addColumn('users.id')
            ->addColumn('users.id', function(User $model) {
                return $model->id;
            })

            ->addColumn('users.user_name', function(User $model) {
                return $model->user_name;
            })

            ->addColumn('role_name')
            ->addColumn('company_name')

            ->addColumn('users.email', function(User $model) {
                return $model->email;
            })

            ->addColumn('created_at_formatted', fn (User $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (User $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'users.id')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('USER NAME', 'users.user_name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make(__('ROLE'), 'role_name', 'roles.role_name')
                ->makeInputMultiSelect(Role::all(), 'role_name', 'role_id')
                ->sortable(),

            Column::make(__('COMPANY'), 'company_name', 'companies.company_name')
                ->makeInputMultiSelect(Company::all(), 'company_name', 'company_id')
                ->sortable(),

            Column::make('EMAIL', 'users.email')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CREATED AT', 'created_at_formatted', 'users.created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'users.updated_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid User Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
       return [

            Button::add('edit')
               ->caption('Edit')
               ->class('btn btn-success btn-sm mt-1')
               ->emit('selectItem', ['id', 'update']),

            Button::add('delete')
               ->caption('Delete')
               ->class('btn btn-danger btn-sm mt-1')
               ->emit('selectItem', ['id', 'delete'])
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid User Action Rules.
     *
     * @return array<int, RuleActions>
     */


    /* public function actionRules(): array
    {
       return [
        Rule::button('edit')
            ->when(fn() => true)
            ->setAttribute('wire:click', ['selectItem' => [
                'itemId' => 'id',
                'action' => 'update',
            ]])
        ];
    } */

}
