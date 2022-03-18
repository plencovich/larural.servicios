<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Logout;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Budget\ShowStatus;
use App\Http\Livewire\Auth\PasswordReset;
use App\Http\Livewire\Budget\ShowDetails;
use App\Http\Livewire\Auth\PasswordForgot;
use App\Http\Controllers\JSLanguageController;
use App\Http\Livewire\Backoffice\Home\Dashboard;
use App\Http\Livewire\Backoffice\Setting\Office;
use App\Http\Livewire\Backoffice\Events\Requests;
use App\Http\Livewire\Backoffice\Setting\Company;
use App\Http\Livewire\Backoffice\Budgets\CreateItems;
use App\Http\Livewire\Backoffice\Products\Categories;
use App\Http\Livewire\Backoffice\Products\EditProduct;
use App\Http\Livewire\Backoffice\Products\ProductsShow;
use App\Http\Livewire\Backoffice\Setting\MailReception;
use App\Http\Livewire\Backoffice\Setting\PaymentMethods;
use App\Http\Livewire\Backoffice\Setting\SocialNetworks;
use App\Http\Livewire\Backoffice\Security\PasswordChange;
use App\Http\Livewire\Backoffice\Setting\MaintenanceMode;
use App\Http\Livewire\Backoffice\Users\Show as UsersShow;
use App\Http\Livewire\Backoffice\Zones\Show as ZonesShow;
use App\Http\Livewire\Backoffice\Events\Show as EventsShow;
use App\Http\Livewire\Backoffice\Budgets\Show as BudgetsShow;
use App\Http\Livewire\Backoffice\Setting\Index as SettingIndex;
use App\Http\Livewire\Backoffice\Budgets\Create as BudgetsCreate;
use App\Http\Livewire\Backoffice\Customers\Show as CustomersShow;
use App\Http\Livewire\Backoffice\Users\Confirms as UsersConfirms;
use App\Http\Livewire\Backoffice\Budgets\Requests as BudgetRequests;

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

// Redirect home
Route::redirect('/', '/backoffice/home');

// JavaScript Localization
Route::get('/js/lang.js', JSLanguageController::class)->name('assets.lang');

/*
|--------------------------------------------------------------------------
| App
|--------------------------------------------------------------------------
|
*/

Route::get('/budgets/{hash}/details', ShowDetails::class)->name('budget.customer-view');
Route::get('/budgets/{hash}/status', ShowStatus::class)->name('budget.customer-status');

Route::group(['middleware' => ['auth']], function () {
    Route::middleware(['account_confirmed'])->group(function () {
        Route::get('/backoffice/home', Dashboard::class)->name('backoffice.home');
        Route::get('/backoffice/security', PasswordChange::class)->name('password.change');
        Route::get('/backoffice/setting', SettingIndex::class)->name('backoffice.setting');
        Route::get('/backoffice/users', UsersShow::class)->name('backoffice.users');
        Route::get('/backoffice/customers', CustomersShow::class)->name('backoffice.customers');
        Route::get('/backoffice/zones', ZonesShow::class)->name('backoffice.zones');
        Route::get('/backoffice/products/list', ProductsShow::class)->name('backoffice.products.list');
        Route::get('/backoffice/products/{product}/edit', EditProduct::class)->name('backoffice.products.edit');
        Route::get('/backoffice/products/categories', Categories::class)->name('backoffice.products.categories');
        Route::get('/backoffice/budgets/list', BudgetsShow::class)->name('backoffice.budgets.list');
        Route::get('/backoffice/budgets/{budget}/edit', CreateItems::class)->name('backoffice.budgets.edit');
        Route::get('/backoffice/budgets/requests', BudgetRequests::class)->name('backoffice.budgets.requests');
        Route::get('/backoffice/events', EventsShow::class)->name('backoffice.events');
        Route::get('/backoffice/events/requests', Requests::class)->name('backoffice.events.requests');
        Route::get('/backoffice/setting/company', Company::class)->name('backoffice.setting.company');
        Route::get('/backoffice/setting/office', Office::class)->name('backoffice.setting.office');
        Route::get('/backoffice/setting/mail-reception', MailReception::class)->name('backoffice.setting.mail-reception');
        Route::get('/backoffice/setting/social-networks', SocialNetworks::class)->name('backoffice.setting.social-networks');
        Route::get('/backoffice/setting/maintenance-mode', MaintenanceMode::class)->name('backoffice.setting.maintenance-mode');
        Route::get('/backoffice/setting/payment-methods', PaymentMethods::class)->name('backoffice.setting.payment-methods');
        Route::get('/backoffice/setting/maintenance/{view_type}', [SettingController::class, 'maintenance'])->name('backoffice.setting.maintenance');
    });
    Route::get('/backoffice/users/confirm', UsersConfirms::class)->name('backoffice.users.confirm');
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/password-forgot', PasswordForgot::class)->name('password.forgot');
    Route::get('/password-reset/{token}/{email}', PasswordReset::class)->name('password.reset');
});

Route::post('/logout', Logout::class)->name('logout')->middleware('auth');
