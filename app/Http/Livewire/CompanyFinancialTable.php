<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyFinancial;
use App\Models\Phase;
use App\Models\Scheme;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use DB;

final class CompanyFinancialTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public string $primaryKey = 'company_financials.id';

    public string $sortField = 'company_financials.id';

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
        return CompanyFinancial::query()
            ->join('companies', function($companies){
                $companies->on('company_financials.company_id', '=', 'companies.id');
            })
            ->join('phases', function ($phases) {
                $phases->on('company_financials.phase_id', '=', 'phases.id');
            })
            ->join('schemes', function ($schemes) {
                $schemes->on('phases.scheme_id', '=', 'schemes.id');
            })
            ->select([
                'company_financials.id',
                'companies.id AS company_id',
                'companies.company_name AS company_name',
                'schemes.id as scheme_id',
                'schemes.scheme_name as scheme_name',
                'phases.phase_name as phase_name',
                'company_financials.total_sanctioned_amount',
                'company_financials.total_installments',
                'company_financials.installment_markup_percentage',
                'company_financials.installment_amount',
                DB::raw('IF(company_financials.is_sanctioned_by_kcbl = 1, "Yes", "No") AS is_sanctioned_by_kcbl'),
                DB::raw('IF(company_financials.is_completed_by_kcbl = 1, "Yes", "No") AS is_completed_by_kcbl'),
                'company_financials.created_at',
                'company_financials.updated_at'
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
            ->addColumn('company_financials.id', function (CompanyFinancial $model) {
                return $model->id;
            })

            ->addColumn('companies.company_name')

            ->addColumn('company_financials.total_sanctioned_amount', function (CompanyFinancial $model) {
                return $model->total_sanctioned_amount;
            })

            ->addColumn('company_financials.total_installments', function (CompanyFinancial $model) {
                return $model->total_installments;
            })

            ->addColumn('company_financials.installment_markup_percentage', function (CompanyFinancial $model) {
                return $model->installment_markup_percentage;
            })

            ->addColumn('company_financials.installment_amount', function (CompanyFinancial $model) {
                return $model->installment_amount;
            })

            ->addColumn('company_financials.is_sanctioned_by_kcbl', function (CompanyFinancial $model) {
                return $model->is_sanctioned_by_kcbl;
            })

            ->addColumn('company_financials.is_completed_by_kcbl', function (CompanyFinancial $model) {
                return $model->is_completed_by_kcbl;
            })

            ->addColumn('scheme_id')
            ->addColumn('scheme_name')
            ->addColumn('phase_name')
            ->addColumn('created_at_formatted', fn (CompanyFinancial $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (CompanyFinancial $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('ID', 'company_financials.id')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make(__('COMPANY'), 'company_name', 'companies.company_name')
                ->makeInputMultiSelect(Company::all(), 'company_name', 'company_id')
                ->sortable(),

            Column::make(__('SCHEME'), 'scheme_name', 'schemes.scheme_name')
                ->makeInputMultiSelect(Scheme::all(), 'scheme_name', 'scheme_id')
                ->sortable(),

            Column::make(__('PHASE'), 'phase_name', 'phases.phase_name')
                ->makeInputMultiSelect(Phase::all(), 'phase_name', 'phase_id')
                ->sortable(),

            Column::make('LOAN AMOUNT', 'company_financials.total_sanctioned_amount')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('TOTAL INSTALLMENTS', 'company_financials.total_installments')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('MARKUP %', 'company_financials.installment_markup_percentage')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('INSTALLMENT AMOUNT', 'company_financials.installment_amount')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('LOAN DISBURSED', 'company_financials.is_sanctioned_by_kcbl')
                ->sortable()
                ->searchable()
                ->makeBooleanFilter(),

            Column::make('COMPLETED', 'company_financials.is_completed_by_kcbl')
                ->sortable()
                ->searchable()
                ->makeBooleanFilter(),

            Column::make('CREATED AT', 'created_at_formatted', 'company_financials.created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'company_financials.updated_at')
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
                ->emit('selectItem', ['id', 'update'])
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
