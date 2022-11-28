<?php

namespace App\Http\Livewire;

use App\Models\Phase;
use App\Models\Scheme;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

use DB;

final class PhaseTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public string $primaryKey = 'phases.id';

    public string $sortField = 'phases.id';

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
    * @return Builder<\App\Models\Phase>
    */
    public function datasource(): Builder
    {
        return Phase::query()
            ->join('schemes', function ($schemes) {
                $schemes->on('phases.scheme_id', '=', 'schemes.id');
            })
            ->select([
                'phases.id',
                'phases.phase_name',
                'schemes.scheme_name as scheme_name',
                'phases.date_from',
                'phases.date_to',
                DB::raw('IF(phases.is_active = 1, "Yes", "No") AS is_active'),
                'phases.created_at',
                'phases.updated_at',
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
            'scheme' => [ // relationship on dishes model
                'scheme_name', // column enabled to search
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
            //->addColumn('phases.id')
            ->addColumn('phases.id', function(Phase $model) {
                return $model->id;
            })

            ->addColumn('phases.phase_name', function(Phase $model) {
                return $model->phase_name;
            })

            ->addColumn('phases.scheme_name', function(Phase $model) {
                return $model->scheme_name;
            })

            ->addColumn('phases.is_active', function (Phase $model) {
                return $model->is_active;
            })

            ->addColumn('date_from_formatted', fn (Phase $model) => Carbon::parse($model->date_from)->format('d/m/Y'))
            ->addColumn('date_to_formatted', fn (Phase $model) => Carbon::parse($model->date_to)->format('d/m/Y'))
            ->addColumn('created_at_formatted', fn (Phase $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Phase $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('ID', 'phases.id')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('Phase NAME', 'phases.phase_name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make(__('Scheme'), 'scheme_name', 'schemes.scheme_name')
                ->makeInputMultiSelect(Scheme::all(), 'scheme_name', 'scheme_id')
                ->sortable(),

            Column::make('DATE FROM', 'date_from_formatted', 'phases.date_from')
                ->sortable()
                ->searchable()
                ->makeInputDatePicker(),

            Column::make('DATE TO', 'date_to_formatted', 'phases.date_to')
                ->sortable()
                ->searchable()
                ->makeInputDatePicker(),

            Column::make('IS ACTIVE', 'phases.is_active')
                ->sortable()
                ->searchable()
                ->makeBooleanFilter(),

            Column::make('CREATED AT', 'created_at_formatted', 'phases.created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'phases.updated_at')
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
     * PowerGrid Phase Action Buttons.
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
     * PowerGrid Phase Action Rules.
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
