<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Company;
use App\Models\District;
use App\Models\Phase;
use App\Models\Scheme;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

use DB;

final class CompanyTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public string $primaryKey = 'companies.id';

    public string $sortField = 'companies.id';

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
     * @return Builder<\App\Models\Company>
     */
    public function datasource(): Builder
    {
        return Company::query()
            ->leftJoin('categories', function ($categories) {
                $categories->on('companies.category_id', '=', 'categories.id');
            })
            ->leftJoin('districts', function ($districts) {
                $districts->on('companies.district_id', '=', 'districts.id');
            })
            ->select([
                'companies.id',
                'companies.company_name',
                'companies.ceo_name',
                'companies.address',
                'companies.cell_no',
                'companies.official_email',
                'companies.online_profile_link',
                'companies.total_employees',
                'companies.total_revenue',
                'companies.total_profit',
                'categories.category_name AS category_name',
                'districts.district_name AS district_name',
                DB::raw('IF(companies.is_completed = 1, "Yes", "No") AS is_completed'),
                'companies.created_at',
                'companies.updated_at',
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
            'category' => [ // relationship on dishes model
                'category_name', // column enabled to search
            ],
            'district' => [ // relationship on dishes model
                'district_name', // column enabled to search
            ],
            'phase' => [ // relationship on dishes model
                'phase_name', // column enabled to search
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
            //->addColumn('companies.id')
            ->addColumn('companies.id', function (Company $model) {
                return $model->id;
            })

            ->addColumn('companies.company_name', function (Company $model) {
                return $model->company_name;
            })

            ->addColumn('companies.ceo_name', function (Company $model) {
                return $model->ceo_name;
            })

            ->addColumn('companies.address', function (Company $model) {
                return $model->address;
            })

            ->addColumn('companies.cell_no', function (Company $model) {
                return $model->cell_no;
            })

            ->addColumn('companies.official_email', function (Company $model) {
                return $model->official_email;
            })

            ->addColumn('companies.online_profile_link', function (Company $model) {
                return $model->online_profile_link;
            })

            ->addColumn('companies.total_employees', function (Company $model) {
                return $model->total_employees;
            })

            ->addColumn('companies.total_revenue', function (Company $model) {
                return $model->total_revenue;
            })

            ->addColumn('companies.total_profit', function (Company $model) {
                return $model->total_profit;
            })

            ->addColumn('category_name')
            ->addColumn('district_name')

            ->addColumn('companies.is_completed', function (Company $model) {
                return $model->is_completed;
            })

            ->addColumn('created_at_formatted', fn (Company $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Company $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('ID', 'companies.id')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('COMPANY NAME', 'companies.company_name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CEO NAME', 'companies.ceo_name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('ADDRESS', 'companies.address')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CELL NO', 'companies.cell_no')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('EMAIL', 'companies.official_email')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('PROFILE LINK', 'companies.online_profile_link')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('TOTAL EMPLOYEES', 'companies.total_employees')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('TOTAL REVENUE', 'companies.total_revenue')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('TOTAL PROFIT', 'companies.total_profit')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make(__('CATEGORY'), 'category_name', 'categories.category_name')
                ->makeInputMultiSelect(Category::all(), 'category_name', 'category_id')
                ->sortable(),

            Column::make(__('DISTRICT'), 'district_name', 'schemes.district_name')
                ->makeInputMultiSelect(District::all(), 'district_name', 'district_id')
                ->sortable(),

            Column::make('COMPLETED', 'companies.is_completed')
                ->sortable()
                ->searchable()
                ->makeBooleanFilter(),

            Column::make('CREATED AT', 'created_at_formatted', 'companies.created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'companies.updated_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Company Action Buttons.
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
     * PowerGrid Company Action Rules.
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
