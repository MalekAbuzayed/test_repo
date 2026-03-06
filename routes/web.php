<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\SessionController;
use App\Http\Controllers\Backend\Auth\AuthBackendController;
use App\Http\Controllers\Backend\Admin\UserBackendController;
use App\Http\Controllers\Backend\Admin\AdminBackendController;
use App\Http\Controllers\Backend\Admin\SliderBackendController;
use App\Http\Controllers\Backend\Admin\AboutUsBackendController;
use App\Http\Controllers\Backend\Admin\ProductBackendController;
use App\Http\Controllers\Backend\Admin\ContactUsBackendController;
use App\Http\Controllers\Backend\Support\SupportBackendController;
use App\Http\Controllers\Backend\Admin\PrivacyPolicyBackendController;
use App\Http\Controllers\Backend\Dashboard\DashboardBackendController;
use App\Http\Controllers\Backend\Admin\TermsConditionBackendController;
use App\Http\Controllers\Backend\Admin\ContactUsRequestBackendController;
use App\Http\Controllers\User\AboutUsController;
use App\Http\Controllers\User\ContactUsController;
use App\Http\Controllers\User\FAQController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\Backend\Admin\OurVisionBackendController;
use App\Http\Controllers\Backend\Admin\OurGoalBackendController;
use App\Http\Controllers\Backend\Admin\TeamMemberBackendController;
use App\Http\Controllers\Backend\Admin\AdminSpecController;
use App\Http\Controllers\Backend\Admin\ProductFileBackendController;


Route::get('/login', [AuthBackendController::class, 'showLoginForm'])->name('login');
Route::get('/admin', [AuthBackendController::class, 'showLoginForm'])->name('welcome');



Route::prefix('super_admin')->name('super_admin.')->group(function () {
    Route::get('/login', [AuthBackendController::class, 'showLoginForm'])->name('loginUser');
    Route::post('/loginFormSubmit', [AuthBackendController::class, 'loginFormSubmit'])->name('loginFormSubmit');
    Route::post('/logout', [AuthBackendController::class, 'logout'])->name('logout');
    Route::group(['middleware' => ['auth:super_admin']], function () {

        // Dashboard Route :
        // Created By:Ayhm, Malek, Abdalah
        // ==============================================================================
        Route::get('/dashboard', [DashboardBackendController::class, 'index'])->name('dashboard');

        // Support Tickets :
        // Created By:Ayhm, Malek, Abdalah
        // ==============================================================================

        Route::group(['prefix' => 'support_tickets'], function () {
            Route::get('/index', [SupportBackendController::class, 'index'])->name('support_tickets-index');
            Route::get('destroy/{id}', [SupportBackendController::class, 'destroy'])->name('support_tickets-destroy');
        });

        // Users :
        // Created By:Ayhm, Malek, Abdalah
        // ==============================================================================

        Route::group(['prefix' => 'users'], function () {
            Route::get('/index', [UserBackendController::class, 'index'])->name('users-index');
            Route::get('/create', [UserBackendController::class, 'create'])->name('users-create');
            Route::post('/store', [UserBackendController::class, 'store'])->name('users-store');
            Route::get('show/{id}', [UserBackendController::class, 'show'])->name('users-show');
            Route::get('edit/{id}', [UserBackendController::class, 'edit'])->name('users-edit');
            Route::post('update/{id}', [UserBackendController::class, 'update'])->name('users-update');
            Route::get('softDelete/{id}', [UserBackendController::class, 'softDelete'])->name('users-softDelete');
            Route::get('/showSoftDelete', [UserBackendController::class, 'showSoftDelete'])->name('users-showSoftDelete');
            Route::get('softDeleteRestore/{id}', [UserBackendController::class, 'softDeleteRestore'])->name('users-softDeleteRestore');
            Route::get('/softDeleteSelected', [UserBackendController::class, 'softDeleteSelected'])->name('users-softDeleteSelected');
            Route::get('/softDeleteRestoreSelected', [UserBackendController::class, 'softDeleteRestoreSelected'])->name('users-softDeleteRestoreSelected');
            Route::get('/activeInactiveSingle/{id}', [UserBackendController::class, 'activeInactiveSingle'])->name('users-activeInactiveSingle');
            Route::get('/activeSelected', [UserBackendController::class, 'activeSelected'])->name('users-activeSelected');
            Route::get('/inactiveSelected', [UserBackendController::class, 'inactiveSelected'])->name('users-inactiveSelected');
            Route::post('/get-available-users', [UserBackendController::class, 'getAvailableUsers']);
        });

        // about_us :
        // Created By Ayhm Rahhal
        // ==============================================================================

        Route::group(['prefix' => 'about_us'], function () {
            Route::get('/index', [AboutUsBackendController::class, 'index'])->name('about_us-index');
            Route::get('edit/{id}', [AboutUsBackendController::class, 'edit'])->name('about_us-edit');
            Route::post('update/{id}', [AboutUsBackendController::class, 'update'])->name('about_us-update');
        });

        // our_vision :
        // Created By Ayhm Rahhal
        // ==============================================================================

        Route::group(['prefix' => 'our_vision'], function () {
            Route::get('/index', [OurVisionBackendController::class, 'index'])->name('our_vision-index');
            Route::get('edit/{id}', [OurVisionBackendController::class, 'edit'])->name('our_vision-edit');
            Route::post('update/{id}', [OurVisionBackendController::class, 'update'])->name('our_vision-update');
        });

        // our_goals :
        // Created By Ayhm Rahhal
        // ==============================================================================

        Route::group(['prefix' => 'our_goals'], function () {
            Route::get('/index', [OurGoalBackendController::class, 'index'])->name('our_goals-index');
            Route::get('/create', [OurGoalBackendController::class, 'create'])->name('our_goals-create');
            Route::post('/store', [OurGoalBackendController::class, 'store'])->name('our_goals-store');
            Route::get('show/{id}', [OurGoalBackendController::class, 'show'])->name('our_goals-show');
            Route::get('edit/{id}', [OurGoalBackendController::class, 'edit'])->name('our_goals-edit');
            Route::post('update/{id}', [OurGoalBackendController::class, 'update'])->name('our_goals-update');
            Route::get('softDelete/{id}', [OurGoalBackendController::class, 'softDelete'])->name('our_goals-softDelete');
            Route::get('/showSoftDelete', [OurGoalBackendController::class, 'showSoftDelete'])->name('our_goals-showSoftDelete');
            Route::get('softDeleteRestore/{id}', [OurGoalBackendController::class, 'softDeleteRestore'])->name('our_goals-softDeleteRestore');
            Route::get('/activeInactiveSingle/{id}', [OurGoalBackendController::class, 'activeInactiveSingle'])->name('our_goals-activeInactiveSingle');
        });

        // team_members :
        Route::group(['prefix' => 'team_members'], function () {
            Route::get('/index', [TeamMemberBackendController::class, 'index'])->name('team_members-index');
            Route::get('/create', [TeamMemberBackendController::class, 'create'])->name('team_members-create');
            Route::post('/store', [TeamMemberBackendController::class, 'store'])->name('team_members-store');
            Route::get('show/{id}', [TeamMemberBackendController::class, 'show'])->name('team_members-show');
            Route::get('edit/{id}', [TeamMemberBackendController::class, 'edit'])->name('team_members-edit');
            Route::post('update/{id}', [TeamMemberBackendController::class, 'update'])->name('team_members-update');
            Route::get('softDelete/{id}', [TeamMemberBackendController::class, 'softDelete'])->name('team_members-softDelete');
            Route::get('/showSoftDelete', [TeamMemberBackendController::class, 'showSoftDelete'])->name('team_members-showSoftDelete');
            Route::get('softDeleteRestore/{id}', [TeamMemberBackendController::class, 'softDeleteRestore'])->name('team_members-softDeleteRestore');
            Route::get('/activeInactiveSingle/{id}', [TeamMemberBackendController::class, 'activeInactiveSingle'])->name('team_members-activeInactiveSingle');
        });

        // contact_us :
        // Created By Ayhm Rahhal
        // ==============================================================================

        Route::group(['prefix' => 'contact_us'], function () {
            Route::get('/index', [ContactUsBackendController::class, 'index'])->name('contact_us-index');
            Route::get('edit/{id}', [ContactUsBackendController::class, 'edit'])->name('contact_us-edit');
            Route::post('update/{id}', [ContactUsBackendController::class, 'update'])->name('contact_us-update');
        });

        // contact_us_requests :
        // Created By Ayhm Rahhal
        // ==============================================================================

        Route::group(['prefix' => 'contact_us_requests'], function () {
            Route::get('/index', [ContactUsRequestBackendController::class, 'index'])->name('contact_us_requests-index');
            Route::get('destroyMessage/{id}', [ContactUsRequestBackendController::class, 'destroyMessage'])->name('contact_us_requests-destroyMessage');
        });

        // privacy_policies
        // Created By Ayhm, Malek, Abdalah
        // ==============================================================================

        Route::group(['prefix' => 'privacy_policies'], function () {
            Route::get('/index', [PrivacyPolicyBackendController::class, 'index'])->name('privacy_policies-index');
            Route::get('/create', [PrivacyPolicyBackendController::class, 'create'])->name('privacy_policies-create');
            Route::post('/store', [PrivacyPolicyBackendController::class, 'store'])->name('privacy_policies-store');
            Route::get('show/{id}', [PrivacyPolicyBackendController::class, 'show'])->name('privacy_policies-show');
            Route::get('edit/{id}', [PrivacyPolicyBackendController::class, 'edit'])->name('privacy_policies-edit');
            Route::post('update/{id}', [PrivacyPolicyBackendController::class, 'update'])->name('privacy_policies-update');
            Route::get('softDelete/{id}', [PrivacyPolicyBackendController::class, 'softDelete'])->name('privacy_policies-softDelete');
            Route::get('/showSoftDelete', [PrivacyPolicyBackendController::class, 'showSoftDelete'])->name('privacy_policies-showSoftDelete');
            Route::get('softDeleteRestore/{id}', [PrivacyPolicyBackendController::class, 'softDeleteRestore'])->name('privacy_policies-softDeleteRestore');
            Route::get('/softDeleteSelected', [PrivacyPolicyBackendController::class, 'softDeleteSelected'])->name('privacy_policies-softDeleteSelected');
            Route::get('/softDeleteRestoreSelected', [PrivacyPolicyBackendController::class, 'softDeleteRestoreSelected'])->name('privacy_policies-softDeleteRestoreSelected');
            Route::get('/activeInactiveSingle/{id}', [PrivacyPolicyBackendController::class, 'activeInactiveSingle'])->name('privacy_policies-activeInactiveSingle');
            Route::get('/activeSelected', [PrivacyPolicyBackendController::class, 'activeSelected'])->name('privacy_policies-activeSelected');
            Route::get('/inactiveSelected', [PrivacyPolicyBackendController::class, 'inactiveSelected'])->name('privacy_policies-inactiveSelected');
        });

        // terms_and_conditions
        // Created By Ayhm, Malek, Abdalah
        // ==============================================================================

        Route::group(['prefix' => 'terms_and_conditions'], function () {
            Route::get('/index', [TermsConditionBackendController::class, 'index'])->name('terms_and_conditions-index');
            Route::get('/create', [TermsConditionBackendController::class, 'create'])->name('terms_and_conditions-create');
            Route::post('/store', [TermsConditionBackendController::class, 'store'])->name('terms_and_conditions-store');
            Route::get('show/{id}', [TermsConditionBackendController::class, 'show'])->name('terms_and_conditions-show');
            Route::get('edit/{id}', [TermsConditionBackendController::class, 'edit'])->name('terms_and_conditions-edit');
            Route::post('update/{id}', [TermsConditionBackendController::class, 'update'])->name('terms_and_conditions-update');
            Route::get('softDelete/{id}', [TermsConditionBackendController::class, 'softDelete'])->name('terms_and_conditions-softDelete');
            Route::get('/showSoftDelete', [TermsConditionBackendController::class, 'showSoftDelete'])->name('terms_and_conditions-showSoftDelete');
            Route::get('softDeleteRestore/{id}', [TermsConditionBackendController::class, 'softDeleteRestore'])->name('terms_and_conditions-softDeleteRestore');
            Route::get('/softDeleteSelected', [TermsConditionBackendController::class, 'softDeleteSelected'])->name('terms_and_conditions-softDeleteSelected');
            Route::get('/softDeleteRestoreSelected', [TermsConditionBackendController::class, 'softDeleteRestoreSelected'])->name('terms_and_conditions-softDeleteRestoreSelected');
            Route::get('/activeInactiveSingle/{id}', [TermsConditionBackendController::class, 'activeInactiveSingle'])->name('terms_and_conditions-activeInactiveSingle');
            Route::get('/activeSelected', [TermsConditionBackendController::class, 'activeSelected'])->name('terms_and_conditions-activeSelected');
            Route::get('/inactiveSelected', [TermsConditionBackendController::class, 'inactiveSelected'])->name('terms_and_conditions-inactiveSelected');
        });

        // Slider Routes :
        // Created By Ayhm, Malek, Abdalah
        // ==============================================================================

        Route::group(['prefix' => 'sliders'], function () {
            Route::get('/index', [SliderBackendController::class, 'index'])->name('sliders-index');
            Route::get('/create', [SliderBackendController::class, 'create'])->name('sliders-create');
            Route::post('/store', [SliderBackendController::class, 'store'])->name('sliders-store');
            Route::get('show/{id}', [SliderBackendController::class, 'show'])->name('sliders-show');
            Route::get('edit/{id}', [SliderBackendController::class, 'edit'])->name('sliders-edit');
            Route::post('update/{id}', [SliderBackendController::class, 'update'])->name('sliders-update');
            Route::get('softDelete/{id}', [SliderBackendController::class, 'softDelete'])->name('sliders-softDelete');
            Route::get('/showSoftDelete', [SliderBackendController::class, 'showSoftDelete'])->name('sliders-showSoftDelete');
            Route::get('softDeleteRestore/{id}', [SliderBackendController::class, 'softDeleteRestore'])->name('sliders-softDeleteRestore');
            Route::get('/softDeleteSelected', [SliderBackendController::class, 'softDeleteSelected'])->name('sliders-softDeleteSelected');
            Route::get('/softDeleteRestoreSelected', [SliderBackendController::class, 'softDeleteRestoreSelected'])->name('sliders-softDeleteRestoreSelected');
            Route::get('/activeInactiveSingle/{id}', [SliderBackendController::class, 'activeInactiveSingle'])->name('sliders-activeInactiveSingle');
            Route::get('/activeSelected', [SliderBackendController::class, 'activeSelected'])->name('sliders-activeSelected');
            Route::get('/inactiveSelected', [SliderBackendController::class, 'inactiveSelected'])->name('sliders-inactiveSelected');
        });

        // Admins :
        // Created By:Ayhm, Malek, Abdalah
        // ==============================================================================

        Route::group(['prefix' => 'admins'], function () {
            Route::get('/index', [AdminBackendController::class, 'index'])->name('admins-index');
            Route::get('/create', [AdminBackendController::class, 'create'])->name('admins-create');
            Route::post('/store', [AdminBackendController::class, 'store'])->name('admins-store');
            Route::get('show/{id}', [AdminBackendController::class, 'show'])->name('admins-show');
            Route::get('edit/{id}', [AdminBackendController::class, 'edit'])->name('admins-edit');
            Route::post('update/{id}', [AdminBackendController::class, 'update'])->name('admins-update');
            Route::get('softDelete/{id}', [AdminBackendController::class, 'softDelete'])->name('admins-softDelete');
            Route::get('/showSoftDelete', [AdminBackendController::class, 'showSoftDelete'])->name('admins-showSoftDelete');
            Route::get('softDeleteRestore/{id}', [AdminBackendController::class, 'softDeleteRestore'])->name('admins-softDeleteRestore');
            Route::get('/softDeleteSelected', [AdminBackendController::class, 'softDeleteSelected'])->name('admins-softDeleteSelected');
            Route::get('/softDeleteRestoreSelected', [AdminBackendController::class, 'softDeleteRestoreSelected'])->name('admins-softDeleteRestoreSelected');
            Route::get('/activeInactiveSingle/{id}', [AdminBackendController::class, 'activeInactiveSingle'])->name('admins-activeInactiveSingle');
            Route::get('/activeSelected', [AdminBackendController::class, 'activeSelected'])->name('admins-activeSelected');
            Route::get('/inactiveSelected', [AdminBackendController::class, 'inactiveSelected'])->name('admins-inactiveSelected');
        });

        // Products Routes
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductBackendController::class, 'index'])->name('products-index');
            Route::get('/create', [ProductBackendController::class, 'create'])->name('products-create');
            Route::post('/store', [ProductBackendController::class, 'store'])->name('products-store');
            Route::get('/show/{id}', [ProductBackendController::class, 'show'])->name('products-show');
            Route::get('/edit/{id}', [ProductBackendController::class, 'edit'])->name('products-edit');
            Route::put('/update/{id}', [ProductBackendController::class, 'update'])->name('products-update');
            Route::get('/softDelete/{id}', [ProductBackendController::class, 'softDelete'])->name('products-softDelete');
            Route::get('/showSoftDelete', [ProductBackendController::class, 'showSoftDelete'])->name('products-showSoftDelete');
            Route::get('/softDeleteRestore/{id}', [ProductBackendController::class, 'softDeleteRestore'])->name('products-softDeleteRestore');
            Route::get('/activeInactiveSingle/{id}', [ProductBackendController::class, 'activeInactiveSingle'])->name('products-activeInactiveSingle');
            Route::get('/softDeleteSelected', [ProductBackendController::class, 'softDeleteSelected'])->name('products-softDeleteSelected');
            Route::get('/softDeleteRestoreSelected', [ProductBackendController::class, 'softDeleteRestoreSelected'])->name('products-softDeleteRestoreSelected');
            Route::get('/activeSelected', [ProductBackendController::class, 'activeSelected'])->name('products-activeSelected');
            Route::get('/inactiveSelected', [ProductBackendController::class, 'inactiveSelected'])->name('products-inactiveSelected');
            Route::delete('/files/{file}', [ProductFileBackendController::class, 'destroy'])
                ->name('product-files.destroy');

            Route::patch('/files/{file}/primary', [ProductFileBackendController::class, 'setPrimary'])
                ->name('product-files.primary');
        });
    });
});





// -------------------------------------------------------- User Routes --------------------------------------------------------------------
Route::get('/', [SessionController::class, 'index'])->name('index');
Route::get('/about', [AboutUsController::class, 'index'])->name('about');
Route::get('/contact_us', [ContactUsController::class, 'index'])->name('contact_us');
Route::get('/faq', [FAQController::class, 'index'])->name('faq');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');
Route::get('/product', [ProductController::class, 'show'])->name('product');
Route::get('/product/specs/key', [ProductController::class, 'keySpecs'])->name('product.specs.key');
Route::get('/product/specs/other', [ProductController::class, 'otherSpecs'])->name('product.specs.other');
Route::get('/product/files/list', [ProductController::class, 'filesList'])->name('product.files.list');
Route::get('/product/files/download/{file}', [ProductController::class, 'downloadFile'])->name('product.files.download');
Route::get('/product/files/download-all', [ProductController::class, 'downloadAll'])->name('product.files.downloadAll');
Route::get('/product/file/{id}', [ProductController::class, 'file'])->name('product.file');
Route::get('/admin/spec-template/{subcategory}', [AdminSpecController::class, 'template'])
    ->name('admin.spec-template');
