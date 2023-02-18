<?php

use App\Http\Controllers\Auth\WebAuthnLoginController;
use App\Http\Controllers\Auth\WebAuthnRegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
 */

Auth::routes(['register' => false]);

Route::get('/forgot-password', function () {
    return view('auth.passwords.email');
})->middleware('guest')->name('password.request');

Route::get('/login-option', 'Auth\LoginController@loginOption')->name("login-option");

Route::post('webauthn/register/options', [WebAuthnRegisterController::class, 'options'])
    ->name('webauthn.register.options');
Route::post('webauthn/register', [WebAuthnRegisterController::class, 'register'])
    ->name('webauthn.register');

Route::post('webauthn/login/options', [WebAuthnLoginController::class, 'options'])
    ->name('webauthn.login.options');
Route::post('webauthn/login', [WebAuthnLoginController::class, 'login'])
    ->name('webauthn.login');

Route::post('checkin-checkout/store', 'CheckinCheckoutController@checkInCheckOutStore');
Route::get('checkin-checkout', 'CheckinCheckoutController@checkInCheckOut');

Route::middleware('auth')->group(function () {

    Route::get('/', 'PageController@home')->name('home');

    Route::resource('employee', 'EmployeeController');
    Route::get('employee/datatable/ssd', 'EmployeeController@ssd');

    Route::get('profile', 'ProfileController@profile')->name('profile.profile');
    Route::get('profile/biometric-data', 'ProfileController@biometricData');
    Route::delete('profile/biometric-data/{id}', 'ProfileController@biometricDataDestroy');

    Route::resource('department', 'DepartmentController');
    Route::get('department/datatable/ssd', 'DepartmentController@ssd');

    Route::resource('designation', 'DesignationController');
    Route::get('designation/datatable/ssd', 'DesignationController@ssd');

    Route::resource('holiday', 'HolidayController');
    Route::get('holiday/datatable/ssd', 'HolidayController@ssd');

    Route::resource('salary', 'SalaryController');
    Route::get('salary/datatable/ssd', 'SalaryController@ssd');

    Route::resource('company-setting', 'CompanySettingController')->only(['edit', 'update', 'show']);
    Route::resource('leave', 'LeaveController');
    Route::get('leave/datatable/ssd', 'LeaveController@ssd');
    Route::get('leave-overview', 'LeaveController@overview')->name('leave.overview');

    
    Route::resource('attendance', 'AttendanceController');
    Route::get('attendance/datatable/ssd', 'AttendanceController@ssd');
    Route::get('attendance-overview', 'AttendanceController@overview')->name('attendance.overview');
    Route::get('attendance-overview-table', 'AttendanceController@overviewTable');
    Route::get('attendance-pdf-download', 'AttendanceController@pdfDownload');

    Route::get('/attendance-scan', 'AttendanceScanController@scan')->name('attendance-scan');
    Route::post('/attendance-scan/store', 'AttendanceScanController@scanStore')->name('attendance-scan.store');
    Route::get('my-attendance/datatable/ssd', 'MyAttendanceController@ssd');
    Route::get('my-attendance-overview-table', 'MyAttendanceController@overviewTable');

    Route::get('payroll', 'PayrollController@payroll')->name('payroll');
    Route::get('payroll-table', 'PayrollController@payrollTable');
    Route::get('my-payroll', 'MyPayrollController@payroll')->name('my-payroll');
    Route::get('my-payroll-table', 'MyPayrollController@payrollTable');

    Route::resource('project', 'ProjectController');
    Route::get('project/datatable/ssd', 'ProjectController@ssd');
    Route::resource('my-project', 'MyProjectController')->only(['index', 'show']);
    Route::get('my-project/datatable/ssd', 'MyProjectController@ssd');

    Route::resource('task', 'TaskController');
    Route::get('task-data', 'TaskController@taskData');
    Route::get('task-draggable', 'TaskController@taskDraggable');

    Route::post('full-calender/action', [FullCalenderController::class, 'action']);    

});
