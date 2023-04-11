<?php

use Illuminate\Support\Facades\Route;

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

// Main Route
Route::group(['prefix' => '/be', 'as' => 'Admin:'], function() {
    // Auth Route
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('Login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'loginStore'])->name('Login:Store');
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('Logout');

    Route::group(['prefix' => '/profile', 'as' => 'Profile:'], function() {
        Route::get('/', [App\Http\Controllers\Admin\Master\ProfileController::class, 'showProfile'])->name('Index');
        Route::get('/profile/activity', [App\Http\Controllers\Admin\Master\ProfileController::class, 'profileActivity'])->name('Activity');
        Route::post('/password/change', [App\Http\Controllers\Admin\Master\ProfileController::class, 'passwordChange'])->name('Password:Change');
        Route::post('/', [App\Http\Controllers\Admin\Master\ProfileController::class, 'profileStore'])->name('Store');
    });

    // Dashboard Route
    Route::group(['prefix' => '/dashboard', 'as' => 'Dashboard:'], function() {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('Index');

        // Data Progress Route
        Route::group(['prefix' => 'distribution', 'as' => 'Distribution:'], function() {
            Route::get('/nasional', [App\Http\Controllers\Admin\DistributionController::class, 'indexNational'])->name('National');
            Route::get('/provinsi', [App\Http\Controllers\Admin\DistributionController::class, 'indexProvince'])->name('Province');
            Route::post('/provinsi/{kode_wilayah}', [App\Http\Controllers\Admin\DistributionController::class, 'indexProvinceDetail'])->name('Province:Detail');
            Route::get('/provinsi/{kode_wilayah}', [App\Http\Controllers\Admin\DistributionController::class, 'indexProvinceDetail'])->name('Province:Detail');
            Route::get('/kabupatenkota', [App\Http\Controllers\Admin\DistributionController::class, 'indexCity'])->name('City');
            Route::post('/kabupatenkota/{kode_wilayah}', [App\Http\Controllers\Admin\DistributionController::class, 'indexCityDetail'])->name('City:Detail');
            Route::get('/kabupatenkota/{kode_wilayah}', [App\Http\Controllers\Admin\DistributionController::class, 'indexCityDetail'])->name('City:Detail');
            Route::get('/detail/school/{npsn}', [App\Http\Controllers\Admin\DistributionController::class, 'schoolDetail'])->name('School:Detail');
        });
        Route::group(['prefix' => 'realization', 'as' => 'Realization:'], function() {
            Route::get('/nasional', [App\Http\Controllers\Admin\RealizationController::class, 'indexNational'])->name('National');
            Route::get('/provinsi', [App\Http\Controllers\Admin\RealizationController::class, 'indexProvince'])->name('Province');
            Route::post('/provinsi/{kode_wilayah}', [App\Http\Controllers\Admin\RealizationController::class, 'indexProvinceDetail'])->name('Province:Detail');
            Route::get('/provinsi/{kode_wilayah}', [App\Http\Controllers\Admin\RealizationController::class, 'indexProvinceDetail'])->name('Province:Detail');
            Route::get('/kabupatenkota', [App\Http\Controllers\Admin\RealizationController::class, 'indexCity'])->name('City');
            Route::post('/kabupatenkota/{kode_wilayah}', [App\Http\Controllers\Admin\RealizationController::class, 'indexCityDetail'])->name('City:Detail');
            Route::get('/kabupatenkota/{kode_wilayah}', [App\Http\Controllers\Admin\RealizationController::class, 'indexCityDetail'])->name('City:Detail');
            Route::get('/detail/school/{npsn}', [App\Http\Controllers\Admin\RealizationController::class, 'schoolDetail'])->name('School:Detail');
        });
        Route::group(['prefix' => 'rkas', 'as' => 'Rkas:'], function() {
            Route::get('/nasional', [App\Http\Controllers\Admin\RkasController::class, 'indexNational'])->name('National');
            Route::get('/provinsi', [App\Http\Controllers\Admin\RkasController::class, 'indexProvince'])->name('Province');
            Route::post('/provinsi/{kode_wilayah}', [App\Http\Controllers\Admin\RkasController::class, 'indexProvinceDetail'])->name('Province:Detail');
            Route::get('/provinsi/{kode_wilayah}', [App\Http\Controllers\Admin\RkasController::class, 'indexProvinceDetail'])->name('Province:Detail');
            Route::get('/kabupatenkota', [App\Http\Controllers\Admin\RkasController::class, 'indexCity'])->name('City');
            Route::post('/kabupatenkota/{kode_wilayah}', [App\Http\Controllers\Admin\RkasController::class, 'indexCityDetail'])->name('City:Detail');
            Route::get('/kabupatenkota/{kode_wilayah}', [App\Http\Controllers\Admin\RkasController::class, 'indexCityDetail'])->name('City:Detail');
            Route::get('/detail/school/{npsn}', [App\Http\Controllers\Admin\RkasController::class, 'schoolDetail'])->name('School:Detail');
        });
        Route::group(['prefix' => 'worksheet', 'as' => 'Worksheet:'], function() {
            Route::get('/', [App\Http\Controllers\Admin\WorksheetController::class, 'index'])->name('Index');
            Route::get('/detail/{id_pengendalian}', [App\Http\Controllers\Admin\WorksheetController::class, 'worksheetDetail'])->name('Detail');
            Route::get('/nasional', [App\Http\Controllers\Admin\WorksheetController::class, 'indexNational'])->name('National');
            Route::get('/provinsi', [App\Http\Controllers\Admin\WorksheetController::class, 'indexProvince'])->name('Province');
            Route::post('/provinsi/{kode_wilayah}', [App\Http\Controllers\Admin\WorksheetController::class, 'indexProvinceDetail'])->name('Province:Detail');
            Route::get('/provinsi/{kode_wilayah}', [App\Http\Controllers\Admin\WorksheetController::class, 'indexProvinceDetail'])->name('Province:Detail');
            Route::get('/kabupatenkota', [App\Http\Controllers\Admin\WorksheetController::class, 'indexCity'])->name('City');
            Route::post('/kabupatenkota/{kode_wilayah}', [App\Http\Controllers\Admin\WorksheetController::class, 'indexCityDetail'])->name('City:Detail');
            Route::get('/kabupatenkota/{kode_wilayah}', [App\Http\Controllers\Admin\WorksheetController::class, 'indexCityDetail'])->name('City:Detail');
            Route::get('/export/{wilayah?}/{kode_wilayah?}', [App\Http\Controllers\Admin\WorksheetController::class, 'worksheetDetailExport'])->name('Export');
            Route::get('/detail/school/{npsn}', [App\Http\Controllers\Admin\WorksheetController::class, 'schoolDetail'])->name('School:Detail');
        });

        // Master Route
        Route::group(['prefix' => '/master', 'as' => 'Master:'], function() {
            // Navigation Route
            Route::resource('/menu/category', App\Http\Controllers\Admin\Master\Navigation\MenuCategoryController::class, [
                'names' => [
                    'index' => 'Menu:Category:Index',
                    'store' => 'Menu:Category:Store',
                    'show' => 'Menu:Category:Show',
                    'update' => 'Menu:Category:Update',
                    'destroy' => 'Menu:Category:Destroy',
                    'edit' => 'Menu:Category:Edit',
                    'create' => 'Menu:Category:Create',
                ]
            ]);
            Route::resource('/menu', App\Http\Controllers\Admin\Master\Navigation\MenuController::class, [
                'names' => [
                    'index' => 'Menu:Index',
                    'store' => 'Menu:Store',
                    'show' => 'Menu:Show',
                    'update' => 'Menu:Update',
                    'destroy' => 'Menu:Destroy',
                    'edit' => 'Menu:Edit',
                    'create' => 'Menu:Create',
                ]
            ]);
            Route::resource('/sub/menu', App\Http\Controllers\Admin\Master\Navigation\SubMenuController::class, [
                'names' => [
                    'index' => 'Sub:Menu:Index',
                    'store' => 'Sub:Menu:Store',
                    'show' => 'Sub:Menu:Show',
                    'update' => 'Sub:Menu:Update',
                    'destroy' => 'Sub:Menu:Destroy',
                    'edit' => 'Sub:Menu:Edit',
                    'create' => 'Sub:Menu:Create',
                ]
            ]);

            // Region Route
            Route::resource('/country', App\Http\Controllers\Admin\Master\Region\CountryController::class, [
                'names' => [
                    'index' => 'Country:Index',
                    'store' => 'Country:Store',
                    'show' => 'Country:Show',
                    'update' => 'Country:Update',
                    'destroy' => 'Country:Destroy',
                    'edit' => 'Country:Edit',
                    'create' => 'Country:Create',
                ]
            ]);
            Route::resource('/province', App\Http\Controllers\Admin\Master\Region\ProvinceController::class, [
                'names' => [
                    'index' => 'Province:Index',
                    'store' => 'Province:Store',
                    'show' => 'Province:Show',
                    'update' => 'Province:Update',
                    'destroy' => 'Province:Destroy',
                    'edit' => 'Province:Edit',
                    'create' => 'Province:Create',
                ]
            ]);
            Route::resource('/city', App\Http\Controllers\Admin\Master\Region\CityController::class, [
                'names' => [
                    'index' => 'City:Index',
                    'store' => 'City:Store',
                    'show' => 'City:Show',
                    'update' => 'City:Update',
                    'destroy' => 'City:Destroy',
                    'edit' => 'City:Edit',
                    'create' => 'City:Create',
                ]
            ]);

            // Route Auth
            Route::resource('/role', App\Http\Controllers\Admin\Master\Auth\RoleController::class, [
                'names' => [
                    'index' => 'Role:Index',
                    'store' => 'Role:Store',
                    'show' => 'Role:Show',
                    'update' => 'Role:Update',
                    'destroy' => 'Role:Destroy',
                    'edit' => 'Role:Edit',
                    'create' => 'Role:Create',
                ]
            ]);
            Route::get('/role/sub/menu/{param_a}/{param_b}', [App\Http\Controllers\Admin\Master\Auth\PrivilegeController::class, 'getSubMenu']);
            Route::get('/role/privilege/{param_a}/{param_b}', [App\Http\Controllers\Admin\Master\Auth\PrivilegeController::class, 'getPrivilege']);
            Route::post('/role/sub/menu', [App\Http\Controllers\Admin\Master\Auth\PrivilegeController::class, 'store'])->name('Role:Sub:Menu:Store');
            Route::resource('/work/unit/user', App\Http\Controllers\Admin\Master\Auth\WorkUnitUserController::class, [
                'names' => [
                    'index' => 'Work:Unit:User:Index',
                    'store' => 'Work:Unit:User:Store',
                    'show' => 'Work:Unit:User:Show',
                    'update' => 'Work:Unit:User:Update',
                    'destroy' => 'Work:Unit:User:Destroy',
                    'edit' => 'Work:Unit:User:Edit',
                    'create' => 'Work:Unit:User:Create',
                ]
            ]);
            Route::resource('/work/unit', App\Http\Controllers\Admin\Master\Auth\WorkUnitController::class, [
                'names' => [
                    'index' => 'Work:Unit:Index',
                    'store' => 'Work:Unit:Store',
                    'show' => 'Work:Unit:Show',
                    'update' => 'Work:Unit:Update',
                    'destroy' => 'Work:Unit:Destroy',
                    'edit' => 'Work:Unit:Edit',
                    'create' => 'Work:Unit:Create',
                ]
            ]);
            Route::resource('/user', App\Http\Controllers\Admin\Master\Auth\UserController::class, [
                'names' => [
                    'index' => 'User:Index',
                    'store' => 'User:Store',
                    'show' => 'User:Show',
                    'update' => 'User:Update',
                    'destroy' => 'User:Destroy',
                    'edit' => 'User:Edit',
                    'create' => 'User:Create',
                ]
            ]);
            Route::get('/region/user/country/{type}', [App\Http\Controllers\Admin\Master\Auth\RegionUserController::class, 'getCountry']);
            Route::get('/region/user/province/{type}/{id_negara}', [App\Http\Controllers\Admin\Master\Auth\RegionUserController::class, 'getProvince']);
            Route::get('/region/user/city/{type}/{id_provinsi}', [App\Http\Controllers\Admin\Master\Auth\RegionUserController::class, 'getCity']);
            Route::get('/region/user/sub/district/{type}/{id_kabupatenkota}', [App\Http\Controllers\Admin\Master\Auth\RegionUserController::class, 'getSubDistrict']);
            Route::resource('/region/user', App\Http\Controllers\Admin\Master\Auth\RegionUserController::class, [
                'names' => [
                    'index' => 'Region:User:Index',
                    'store' => 'Region:User:Store',
                    'show' => 'Region:User:Show',
                    'update' => 'Region:User:Update',
                    'destroy' => 'Region:User:Destroy',
                    'edit' => 'Region:User:Edit',
                    'create' => 'Region:User:Create',
                ]
            ]);

            // Route Stages
            Route::resource('/control/activity', App\Http\Controllers\Admin\Master\Stages\ControlActivityController::class, [
                'names' => [
                    'index' => 'Control:Activity:Index',
                    'store' => 'Control:Activity:Store',
                    'show' => 'Control:Activity:Show',
                    'update' => 'Control:Activity:Update',
                    'destroy' => 'Control:Activity:Destroy',
                    'edit' => 'Control:Activity:Edit',
                    'create' => 'Control:Activity:Create',
                ]
            ]);
            Route::resource('/activity', App\Http\Controllers\Admin\Master\Stages\ActivityController::class, [
                'names' => [
                    'index' => 'Activity:Index',
                    'store' => 'Activity:Store',
                    'show' => 'Activity:Show',
                    'update' => 'Activity:Update',
                    'destroy' => 'Activity:Destroy',
                    'edit' => 'Activity:Edit',
                    'create' => 'Activity:Create',
                ]
            ]);
            Route::resource('/year', App\Http\Controllers\Admin\Master\Stages\FiscalYearController::class, [
                'names' => [
                    'index' => 'Fiscal:Year:Index',
                    'store' => 'Fiscal:Year:Store',
                    'show' => 'Fiscal:Year:Show',
                    'update' => 'Fiscal:Year:Update',
                    'destroy' => 'Fiscal:Year:Destroy',
                    'edit' => 'Fiscal:Year:Edit',
                    'create' => 'Fiscal:Year:Create',
                ]
            ]);
            Route::resource('/instrument', App\Http\Controllers\Admin\Master\Stages\InstrumentController::class, [
                'names' => [
                    'index' => 'Instrument:Index',
                    'store' => 'Instrument:Store',
                    'show' => 'Instrument:Show',
                    'update' => 'Instrument:Update',
                    'destroy' => 'Instrument:Destroy',
                    'edit' => 'Instrument:Edit',
                    'create' => 'Instrument:Create',
                ]
            ]);
            Route::resource('/group/activity', App\Http\Controllers\Admin\Master\Stages\GroupActivityController::class, [
                'names' => [
                    'index' => 'Group:Activity:Index',
                    'store' => 'Group:Activity:Store',
                    'show' => 'Group:Activity:Show',
                    'update' => 'Group:Activity:Update',
                    'destroy' => 'Group:Activity:Destroy',
                    'edit' => 'Group:Activity:Edit',
                    'create' => 'Group:Activity:Create',
                ]
            ]);
            Route::get('/school', [App\Http\Controllers\Admin\Master\Stages\SchoolController::class, 'index'])->name('School:Index');
        });

        // Stages Route
        Route::group(['prefix' => '/stages', 'as' => 'Stages:'], function() {
            Route::put('/approval/{id_pengendalian}', [App\Http\Controllers\Admin\Stages\ApprovalController::class, 'approve'])->name('Approval:Approve');
            Route::put('/reject', [App\Http\Controllers\Admin\Stages\ApprovalController::class, 'reject'])->name('Approval:Reject');
            Route::put('/resend/{id_pengendalian}', [App\Http\Controllers\Admin\Stages\ApprovalController::class, 'resend'])->name('Approval:Resend');
            Route::get('/approval/detail/worksheet/{id_pengendalian}', [App\Http\Controllers\Admin\Stages\ApprovalController::class, 'approveDetail'])->name('Approval:Detail');
            
            // Route Desk Audit
            Route::group(['prefix' => '/desk', 'as' => 'Desk:'], function () {
                Route::get('/monitoring', [App\Http\Controllers\Admin\Stages\MonitoringController::class, 'index'])->name('Monitoring:Index');
                Route::get('/distribution', [App\Http\Controllers\Admin\Stages\DistributionController::class, 'index'])->name('Distribution:Index');
                Route::get('/implementation', [App\Http\Controllers\Admin\Stages\ImplementationController::class, 'index'])->name('Implementation:Index');
                Route::post('/implementation', [App\Http\Controllers\Admin\Stages\ImplementationController::class, 'store'])->name('Implementation:Store');
                Route::get('/management', [App\Http\Controllers\Admin\Stages\ManagementController::class, 'index'])->name('Management:Index');
                Route::get('/approval', [App\Http\Controllers\Admin\Stages\ApprovalController::class, 'index'])->name('Approval:Index');
                Route::get('/report', [App\Http\Controllers\Admin\Stages\ReportController::class, 'index'])->name('Report:Index');
                Route::post('/report', [App\Http\Controllers\Admin\Stages\ReportController::class, 'download'])->name('Report:Download');
            });

            // Route Field Audit
            Route::group(['prefix' => '/field', 'as' => 'Field:'], function () {
                Route::get('/monitoring', [App\Http\Controllers\Admin\Stages\MonitoringController::class, 'index'])->name('Monitoring:Index');
                Route::get('/implementation', [App\Http\Controllers\Admin\Stages\ImplementationController::class, 'index'])->name('Implementation:Index');
                Route::post('/implementation', [App\Http\Controllers\Admin\Stages\ImplementationController::class, 'store'])->name('Implementation:Store');
                Route::get('/management', [App\Http\Controllers\Admin\Stages\ManagementController::class, 'index'])->name('Management:Index');
                Route::post('/management', [App\Http\Controllers\Admin\Stages\ManagementController::class, 'store'])->name('Management:Store');
                Route::get('/implementation/worksheet/{id_pengendalian}/{tahun}', [App\Http\Controllers\Admin\Stages\ImplementationController::class, 'FieldWorksheet'])->name('Implementation:Worksheet');
                Route::get('/approval', [App\Http\Controllers\Admin\Stages\ApprovalController::class, 'index'])->name('Approval:Index');
            });

            // Ajax Route
            Route::get('/city/{province}', [App\Http\Controllers\Admin\Stages\DetailController::class, 'getCity']);
            // Route::get('/sub/district/{city}', [App\Http\Controllers\Admin\Stages\DetailController::class, 'getSubDistrict']);
            Route::get('/school/{city}', [App\Http\Controllers\Admin\Stages\DetailController::class, 'getSchool']);
            Route::get('/fiscal/year/{school}', [App\Http\Controllers\Admin\Stages\DetailController::class, 'getFiscalYear']);
            Route::post('/worksheet/2', [App\Http\Controllers\Admin\Stages\DetailController::class, 'getWorksheet2'])->name('Get:Worksheet2');
            Route::post('/worksheet/management', [App\Http\Controllers\Admin\Stages\DetailController::class, 'getWorksheetManagement'])->name('Get:Worksheet:Management');
            Route::post('/worksheet', [App\Http\Controllers\Admin\Stages\DetailController::class, 'getWorksheet'])->name('Get:Worksheet');

            Route::group(['prefix' => '/related/files', 'as' => 'Files:'], function() {
                Route::get('/rkas/{npsn}', [App\Http\Controllers\Admin\Stages\FilesController::class, 'rkas'])->name('Rkas');
                Route::get('/rkas/221/{npsn}', [App\Http\Controllers\Admin\Stages\FilesController::class, 'rkas221'])->name('Rkas:221');
                Route::get('/sptmh/{npsn}', [App\Http\Controllers\Admin\Stages\FilesController::class, 'sptmh'])->name('Sptmh');
                Route::get('/bku/{npsn}', [App\Http\Controllers\Admin\Stages\FilesController::class, 'bku'])->name('Bku');
                Route::get('/bku/silpa/{npsn}', [App\Http\Controllers\Admin\Stages\FilesController::class, 'bkuSilpa'])->name('Bku:Silpa');
                Route::get('/penggunaan/{npsn}', [App\Http\Controllers\Admin\Stages\FilesController::class, 'penggunaan'])->name('Penggunaan');
            });
        });
    });
});

Route::get('/', function () {
    return redirect()->route('Admin:Login');
});
