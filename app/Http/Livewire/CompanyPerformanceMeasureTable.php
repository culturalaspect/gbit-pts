<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyPerformanceMeasure;
use App\Models\PerformanceMeasure;
use App\Models\Phase;
use App\Models\Scheme;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use DB;

final class CompanyPerformanceMeasureTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public string $primaryKey = 'company_performance_measures.id';

    public string $sortField = 'company_performance_measures.id';

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
     * @return Builder<\App\Models\CompanyPerformanceMeasure>
     */
    public function datasource(): Builder
    {
        return CompanyPerformanceMeasure::query()
            ->join('companies', function($companies) {
                $companies->on('company_performance_measures.company_id', '=', 'companies.id');
            })
            ->join('performance_measures', function($performance_measures) {
                $performance_measures->on('company_performance_measures.measure_id', '=', 'performance_measures.id');
            })
            ->join('phases', function ($phases) {
                $phases->on('company_performance_measures.phase_id', '=', 'phases.id');
            })
            ->join('schemes', function ($schemes) {
                $schemes->on('phases.scheme_id', '=', 'schemes.id');
            })
            ->select([
                'company_performance_measures.id',
                'performance_measures.id AS measure_id',
                'performance_measures.measure_name',
                'companies.id AS company_id',
                'companies.company_name',
                'schemes.id as scheme_id',
                'schemes.scheme_name as scheme_name',
                'phases.phase_name as phase_name',
                'company_performance_measures.total_employees',
                'company_performance_measures.total_revenue',
                'company_performance_measures.total_profit',
                'company_performance_measures.total_amount_utilized',
                DB::raw('IF(company_performance_measures.is_completed = 1, "Yes", "No") AS is_completed'),
                'company_performance_measures.updated_at',
                'company_performance_measures.created_at'
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
            ->addColumn('company_performance_measures.id', function (CompanyPerformanceMeasure $model) {
                return $model->id;
            })

            ->addColumn('measure_id')
            ->addColumn('measure_name')
            ->addColumn('company_id')
            ->addColumn('company_name')
            ->addColumn('scheme_id')
            ->addColumn('scheme_name')
            ->addColumn('phase_name')

            ->addColumn('company_performance_measures.total_employees', function (CompanyPerformanceMeasure $model) {
                return $model->total_employees;
            })

            ->addColumn('company_performance_measures.total_revenue', function (CompanyPerformanceMeasure $model) {
                return $model->total_revenue;
            })

            ->addColumn('company_performance_measures.total_profit', function (CompanyPerformanceMeasure $model) {
                return $model->total_profit;
            })

            ->addColumn('company_performance_measures.total_amount_utilized', function (CompanyPerformanceMeasure $model) {
                return $model->total_amount_utilized;
            })

            ->addColumn('company_performance_measures.is_completed', function (CompanyPerformanceMeasure $model) {
                return $model->is_completed;
            })

            ->addColumn('created_at_formatted', fn (CompanyPerformanceMeasure $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (CompanyPerformanceMeasure $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('ID', 'company_performance_measures.id')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make(__('MEASURE'), 'measure_name', 'performance_measures.measure_name')
                ->makeInputMultiSelect(PerformanceMeasure::all(), 'measure_name', 'measure_id')
                ->sortable(),

            Column::make(__('COMPANY'), 'company_name', 'companies.company_name')
                ->makeInputMultiSelect(Company::all(), 'company_name', 'company_id')
                ->sortable(),

            Column::make(__('SCHEME'), 'scheme_name', 'schemes.scheme_name')
                ->makeInputMultiSelect(Scheme::all(), 'scheme_name', 'scheme_id')
                ->sortable(),

            Column::make(__('PHASE'), 'phase_name', 'phases.phase_name')
                ->makeInputMultiSelect(Phase::all(), 'phase_name', 'phase_id')
                ->sortable(),

            Column::make('EMPLOYEES', 'company_performance_measures.total_employees')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('REVENUE', 'company_performance_measures.total_revenue')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('PROFIT', 'company_performance_measures.total_profit')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('UTILIZATION', 'company_performance_measures.total_amount_utilized')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('COMPLETED', 'company_performance_measures.is_completed')
                ->sortable()
                ->searchable()
                ->makeBooleanFilter(),

            Column::make('CREATED AT', 'created_at_formatted', 'company_performance_measures.created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'company_performance_measures.updated_at')
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
     * PowerGrid CompanyPerformanceMeasure Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::add('update-questions')
                ->caption('Update Questions')
                ->class('btn btn-warning btn-sm mt-1')
                ->emit('updatePerformanceQuestions', ['id']),

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
     * PowerGrid CompanyPerformanceMeasure Action Rules.
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
