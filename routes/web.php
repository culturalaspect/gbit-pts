<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Livewire\Admin\AdminIndex;
use App\Http\Livewire\Admin\DistrictsIndex;
use App\Http\Livewire\Admin\CategoriesIndex;
use App\Http\Livewire\Admin\DomainsIndex;
use App\Http\Livewire\Admin\SchemesIndex;
use App\Http\Livewire\Admin\PhasesIndex;
use App\Http\Livewire\Admin\CompaniesIndex;
use App\Http\Livewire\Admin\CompanyFinancialsIndex;
use App\Http\Livewire\Admin\CompanyProjectsIndex;
use App\Http\Livewire\Admin\ProjectActivitiesIndex;
use App\Http\Livewire\Admin\CompanyInstallmentsIndex;
use App\Http\Livewire\Admin\PerformanceMeasuresIndex;
use App\Http\Livewire\Admin\CompanyPerformanceMeasuresIndex;
use App\Http\Livewire\Admin\UsersIndex;
use App\Http\Livewire\Admin\CompanyProgressIndex;
use App\Http\Livewire\Admin\RolesIndex;
use App\Http\Livewire\Admin\SettingsIndex;

use App\Http\Livewire\Bank\BankIndex;
use App\Http\Livewire\Company\CompanyIndex;
use App\Http\Livewire\Company\ProfileIndex;
use App\Http\Livewire\Company\PerformanceMeasureIndex;
use App\Http\Livewire\Company\ProjectAndActivitiesIndex;
use App\Http\Livewire\Company\ActivityUpdateIndex;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
	return Redirect::to('users/login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'isadmin'], function () {

    Route::get('/', AdminIndex::class);
    Route::get('/index', AdminIndex::class);
    Route::get('/dashboard', AdminIndex::class)->name('admin.index');

    Route::get('/districts', DistrictsIndex::class)->name('admin.districts.index');
    Route::get('/categories', CategoriesIndex::class)->name('admin.categories.index');
    Route::get('/domains', DomainsIndex::class)->name('admin.domains.index');
    Route::get('/schemes', SchemesIndex::class)->name('admin.schemes.index');
    Route::get('/phases', PhasesIndex::class)->name('admin.phases.index');
    Route::get('/companies', CompaniesIndex::class)->name('admin.companies.index');
    Route::get('/projects', CompanyProjectsIndex::class)->name('admin.projects.index');
    Route::get('/activities', ProjectActivitiesIndex::class)->name('admin.activities.index');
    Route::get('/companyfinancials', CompanyFinancialsIndex::class)->name('admin.companyfinancials.index');
    Route::get('/companyinstallments', CompanyInstallmentsIndex::class)->name('admin.companyinstallments.index');
    Route::get('/performancemeasures', PerformanceMeasuresIndex::class)->name('admin.performancemeasures.index');
    Route::get('/companyperformancemeasures', CompanyPerformanceMeasuresIndex::class)->name('admin.companyperformancemeasures.index');
    Route::get('/roles', RolesIndex::class)->name('admin.roles.index');
    Route::get('/users', UsersIndex::class)->name('admin.users.index');
    Route::get('/settings', SettingsIndex::class)->name('admin.settings.index');
    Route::get('/companyprogress/{company_id}/{phase_id}', CompanyProgressIndex::class);
});

Route::group(['prefix' => 'bank', 'middleware' => 'isbank'], function () {
	Route::get('/index', BankIndex::class);
	Route::get('/', BankIndex::class);
	Route::get('/dashboard', BankIndex::class)->name('bank.index');

    Route::get('/companyfinancials', CompanyFinancialsIndex::class)->name('bank.companyfinancials.index');
    Route::get('/companyinstallments', CompanyInstallmentsIndex::class)->name('bank.companyinstallments.index');
    Route::get('/settings', SettingsIndex::class)->name('bank.settings.index');
    Route::get('/companyprogress/{company_id}/{phase_id}', CompanyProgressIndex::class);
});

Route::group(['prefix' => 'company', 'middleware' => 'iscompany'], function () {
	Route::get('/index', CompanyIndex::class);
	Route::get('/', CompanyIndex::class);
	Route::get('/dashboard', CompanyIndex::class)->name('company.index');

    Route::get('/profile', ProfileIndex::class)->name('company.profile.index');
    Route::get('/projectsandactivities', ProjectAndActivitiesIndex::class)->name('company.projectsandactivities.index');
    Route::get('/activities/{activity_id}', ActivityUpdateIndex::class);
    Route::get('/performancemeasure/{measure_id}/{phase_id}', PerformanceMeasureIndex::class);
    Route::get('/settings', SettingsIndex::class)->name('company.settings.index');
    Route::get('/companyprogress/{company_id}/{phase_id}', CompanyProgressIndex::class);
});

Route::get('users/login', [UsersController::class, 'index'])->name('users.login');
Route::post('users/signin', [UsersController::class, 'signin'])->name('users.signin');
Route::get('users/register', [UsersController::class, 'register'])->name('users.register');
//Route::get('users/forgetpassword', [UsersController::class, 'forgetpassword'])->name('users.forgetpassword');
//Route::get('users/resetpassword/{email}', [UsersController::class, 'resetpassword']);
//Route::post('users/verifyemail', [UsersController::class, 'verifyemail'])->name('users.verifyemail');
//Route::post('users/setnewpassword', [UsersController::class, 'setnewpassword'])->name('users.setnewpassword');
Route::get('users/signout', [UsersController::class, 'signout'])->name('users.signout');
//Route::post('users/storeuser', [UsersController::class, 'storeuser'])->name('users.storeuser');
Route::get('users/permissiondenied', [UsersController::class, 'permissiondenied'])->name('users.permissiondenied');
