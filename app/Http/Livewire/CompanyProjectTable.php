<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Domain;
use App\Models\Project;
use App\Models\Phase;
use App\Models\Scheme;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use DB;

final class CompanyProjectTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public string $primaryKey = 'projects.id';

    public string $sortField = 'projects.id';

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
        return Project::query()
            ->join('companies', function($companies){
                $companies->on('projects.company_id', '=', 'companies.id');
            })
            ->join('domains', function ($domains) {
                $domains->on('projects.domain_id', '=', 'domains.id');
            })
            ->select([
                'projects.id',
                'companies.id AS company_id',
                'companies.company_name AS company_name',
                'projects.project_title',
                'domains.id as domain_id',
                'domains.domain_name as domain_name',
                'projects.other_domain',
                'projects.problem_statement',
                'projects.summary_of_solution',
                'projects.expected_results',
                'projects.organizational_expertise',
                'projects.created_at',
                'projects.updated_at'
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
            ->addColumn('projects.id', function (Project $model) {
                return $model->id;
            })

            ->addColumn('companies.company_name')

            ->addColumn('projects.project_title', function (Project $model) {
                return $model->project_title;
            })

            ->addColumn('domains.domain_name')

            ->addColumn('projects.other_domain', function (Project $model) {
                return $model->other_domain;
            })

            ->addColumn('projects.problem_statement', function (Project $model) {
                return $model->problem_statement;
            })

            ->addColumn('projects.summary_of_solution', function (Project $model) {
                return $model->summary_of_solution;
            })

            ->addColumn('projects.expected_results', function (Project $model) {
                return $model->expected_results;
            })

            ->addColumn('projects.organizational_expertise', function (Project $model) {
                return $model->organizational_expertise;
            })

            ->addColumn('created_at_formatted', fn (Project $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Project $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('ID', 'projects.id')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make(__('COMPANY'), 'company_name', 'companies.company_name')
                ->makeInputMultiSelect(Company::all(), 'company_name', 'company_id')
                ->sortable(),

            Column::make('PROJECT TITLE', 'projects.project_title')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make(__('DOMAIN'), 'domain_name', 'domains.domain_name')
                ->makeInputMultiSelect(Domain::all(), 'domain_name', 'domain_id')
                ->sortable(),

            Column::make('OTHER DOMAIN', 'projects.other_domain')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('PROBLEM', 'projects.problem_statement')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('SOLUTION', 'projects.summary_of_solution')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('RESULTS', 'projects.expected_results')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('EXPERTISE', 'projects.organizational_expertise')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CREATED AT', 'created_at_formatted', 'projects.created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'projects.updated_at')
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
