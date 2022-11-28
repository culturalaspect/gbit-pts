<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyInstallment;
use App\Models\Phase;
use App\Models\Scheme;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use DB;

final class CompanyInstallmentTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public string $primaryKey = 'company_installments.id';

    public string $sortField = 'company_installments.id';

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
     * @return Builder<\App\Models\CompanyInstallment>
     */
    public function datasource(): Builder
    {
        return CompanyInstallment::query()
            ->join('companies', function($companies) {
                $companies->on('company_installments.company_id', '=', 'companies.id');
            })
            ->join('phases', function ($phases) {
                $phases->on('company_installments.phase_id', '=', 'phases.id');
            })
            ->join('schemes', function ($schemes) {
                $schemes->on('phases.scheme_id', '=', 'schemes.id');
            })
            ->select([
                'company_installments.id',
                'companies.id AS company_id',
                'companies.company_name',
                'schemes.id as scheme_id',
                'schemes.scheme_name as scheme_name',
                'phases.phase_name as phase_name',
                'company_installments.installment_no',
                'company_installments.amount_paid',
                'company_installments.date_of_payment',
                'company_installments.created_at',
                'company_installments.updated_at'
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
            ->addColumn('company_installments.id', function (CompanyInstallment $model) {
                return $model->id;
            })

            ->addColumn('company_id')
            ->addColumn('company_name')
            ->addColumn('scheme_id')
            ->addColumn('scheme_name')
            ->addColumn('phase_name')

            ->addColumn('company_installments.installment_no', function (CompanyInstallment $model) {
                return $model->installment_no;
            })

            ->addColumn('company_installments.amount_paid', function (CompanyInstallment $model) {
                return $model->amount_paid;
            })

            ->addColumn('date_of_payment_formatted', fn (CompanyInstallment $model) => Carbon::parse($model->date_of_payment)->format('d/m/Y'))
            ->addColumn('created_at_formatted', fn (CompanyInstallment $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (CompanyInstallment $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('ID', 'company_installments.id')
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

            Column::make('INSTALLMENT #', 'company_installments.installment_no')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('AMOUNT PAID', 'company_installments.amount_paid')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make('PAYMENT DATE', 'date_of_payment_formatted', 'company_installments.date_of_payment')
                ->sortable()
                ->searchable()
                ->makeInputDatePicker(),

            Column::make('CREATED AT', 'created_at_formatted', 'company_installments.created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'company_installments.updated_at')
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
     * PowerGrid CompanyInstallment Action Buttons.
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
     * PowerGrid CompanyInstallment Action Rules.
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
