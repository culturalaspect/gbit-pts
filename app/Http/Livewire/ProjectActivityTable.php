<?php

namespace App\Http\Livewire;

use DB;
use App\Models\Company;
use App\Models\Project;
use App\Models\Activity;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ProjectActivityTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public string $primaryKey = 'activities.id';

    public string $sortField = 'activities.id';

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
        return Activity::query()
            ->join('projects', function ($projects) {
                $projects->on('activities.project_id', '=', 'projects.id');
            })
            ->join('companies', function($companies){
                $companies->on('projects.company_id', '=', 'companies.id');
            })
            ->select([
                'activities.id',
                'companies.id AS company_id',
                'companies.company_name AS company_name',
                'activities.activity_title',
                'projects.id as project_id',
                'projects.project_title as project_title',
                'activities.methodology',
                'activities.start_date',
                'activities.end_date',
                'activities.status',
                'activities.deliverable',
                'activities.result',
                DB::raw('IF(activities.is_deadline_set = 1, "Yes", "No") AS is_deadline_set'),
                'activities.created_at',
                'activities.updated_at'
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
            ->addColumn('activities.id', function (Activity $model) {
                return $model->id;
            })

            ->addColumn('companies.company_name')

            ->addColumn('activities.project_title', function (Activity $model) {
                return $model->project_title;
            })

            ->addColumn('projects.project_title')

            ->addColumn('activities.activity_title', function (Activity $model) {
                return $model->activity_title;
            })

            ->addColumn('activities.methodology', function (Activity $model) {
                return $model->methodology;
            })

            ->addColumn('start_date_formatted', fn (Activity $model) => Carbon::parse($model->start_date)->format('d/m/Y'))
            ->addColumn('end_date_formatted', fn (Activity $model) => Carbon::parse($model->end_date)->format('d/m/Y'))

            ->addColumn('activities.status', function (Activity $model) {
                return $model->status;
            })

            ->addColumn('activities.status', function (Activity $model) {
                return $model->status == 0 ? '<span class="badge bg-primary">In Progress</span>' : ($model->status == 1 ? '<span class="badge bg-success">Completed</span>' : '<span class="badge bg-danger">N/A</span>');
            })

            ->addColumn('activities.deliverable', function (Activity $model) {
                return '<a download class="btn btn-warning btn-outline" href="'. url('storage/deliverables/'.$model->deliverable) .'">Download Deliverable</a>';
            })

            ->addColumn('activities.result', function (Activity $model) {
                return $model->result;
            })

            ->addColumn('activities.is_deadline_set', function (Activity $model) {
                return $model->is_deadline_set;
            })

            ->addColumn('created_at_formatted', fn (Activity $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Activity $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('ID', 'activities.id')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::make(__('COMPANY'), 'company_name', 'companies.company_name')
                ->makeInputMultiSelect(Company::all(), 'company_name', 'company_id')
                ->sortable(),

            Column::make(__('PROJECT'), 'project_title', 'projects.project_title')
                ->makeInputMultiSelect(Project::all(), 'project_title', 'project_id')
                ->sortable(),

            Column::make('ACTIVITY TITLE', 'activities.activity_title')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('METHODOLOGY', 'activities.methodology')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('START DATE', 'start_date_formatted', 'start_date')
                ->sortable()
                ->searchable()
                ->makeInputDatePicker(),

            Column::make('END DATE', 'end_date_formatted', 'end_date')
                ->sortable()
                ->searchable()
                ->makeInputDatePicker(),

            Column::make('STATUS', 'activities.status')
                ->sortable()
                ->searchable()
                ->makeInputSelect(Activity::statuses(), 'label', 'status'),

            /* Column::make('SOLUTION', 'activities.summary_of_solution')
                ->sortable()
                ->searchable()
                ->makeInputText(), */

            Column::make('DELIVERABLE', 'activities.deliverable')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('RESULT', 'activities.result')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('IS DEADLINE SET', 'activities.is_deadline_set')
                ->sortable()
                ->searchable()
                ->makeBooleanFilter(),

            Column::make('CREATED AT', 'created_at_formatted', 'activities.created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'activities.updated_at')
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
