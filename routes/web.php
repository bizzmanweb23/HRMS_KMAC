<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\WarningController;
use App\Http\Controllers\Admin\TerminationController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\EmployeeDetailsController;

use App\Http\Controllers\Admin\Employee\BonusController;
use App\Http\Controllers\Admin\Employee\CertificateController;
use App\Http\Controllers\Admin\Employee\EducationController;
use App\Http\Controllers\Admin\Employee\LicenceController;
use App\Http\Controllers\Admin\Employee\ReferalController;
use App\Http\Controllers\Admin\Employee\VaccinationController;
use App\Http\Controllers\Admin\Employee\WsqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;

use Illuminate\Support\Facades\DB;
 
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

Route::get('login',[AdminAuthController::class, 'index'])->name('admin.login');
Route::post('login',[AdminAuthController::class, 'login_check']);

Route::get('register',[AdminAuthController::class, 'register'])->name('admin.register');
Route::post('register',[AdminAuthController::class, 'register_new']);

Route::get('logout',[AdminAuthController::class, 'logout']);

Route::get('company/list',[HomeController::class, 'company_list']);
Route::get('employee/list',[HomeController::class, 'employee_list']);

Route::group(['middleware'=>'authcheck'], function() {  
	
Route::any('/dashboard', [DashboardController::class, 'index']);
Route::any('/', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('user/profile',[UserController::class, 'profile'])->name('profile');
Route::get('edit/profile',[UserController::class, 'edit_profile'])->name('edit.profile');

Route::get('/cpf', [HomeController::class, 'cpf']);
Route::get('cpf/data', [HomeController::class, 'cpf_data']);
Route::get('/iras',[HomeController::class, 'iras']);
Route::post('add/cpf',[HomeController::class, 'add_cpf']);

Route::post('dependent',[EmployeeDetailsController::class, 'index']);
//employee 

Route::get('employee',[EmployeeController::class, 'index'])->name('emp.list');
Route::get('employee/tabs',[EmployeeController::class, 'employee_tabs'])->name('emp.tabs');
Route::get('add/employee/form',[EmployeeController::class, 'employee_add_form'])->name('emp.add');
Route::post('employee/vew',[EmployeeController::class, 'view'])->name('emp.view');
Route::any('employee/delete/{id}',[EmployeeController::class, 'destroy'])->name('emp.delete'); 
Route::post('employee/edit',[EmployeeController::class, 'edit'])->name('emp.edit');
Route::get('employee/tab/edit/{id}',[EmployeeController::class, 'employee_tab_edit'])->name('emp.tab.edit');
Route::post('employee/update',[EmployeeController::class, 'update']);
Route::post('add/employee',[EmployeeController::class, 'store']);
//attachmet
 
Route::get('education',[LicenceController::class, 'index']);  

Route::get('joining/bonus',[BonusController::class, 'index'])->name('emp.bonus');
Route::get('get/bonus/list',[BonusController::class, 'getall']);
Route::post('add/bonus',[BonusController::class, 'store']);
Route::any('delete/bonus',[BonusController::class, 'delete']);
Route::any('view/bonus',[BonusController::class, 'view']);


Route::get('emp/certificate',[CertificateController::class, 'index'])->name('emp.certificate');
Route::post('add/certificate',[CertificateController::class, 'store']);
Route::any('delete/certificate',[CertificateController::class, 'delete']); 

Route::get('emp/referal',[ReferalController::class, 'index'])->name('emp.referal');
Route::post('add/referal',[ReferalController::class, 'store']);
Route::any('delete/referal',[ReferalController::class, 'delete']);

Route::get('licence',[LicenceController::class, 'index'])->name('emp.licence');
Route::get('emp/data',[LicenceController::class, 'data_table'])->name('emp.licence.data');

Route::post('add/licence',[LicenceController::class, 'store']);
Route::post('licence/view',[LicenceController::class, 'view']);
Route::any('delete/licence',[LicenceController::class, 'delete']); 

Route::get('emp/education',[EducationController::class, 'index'])->name('emp.education');
Route::post('add/education',[EducationController::class, 'store']);
Route::any('delete/education',[EducationController::class, 'delete']);
Route::post('view/education',[EducationController::class, 'view']);

Route::get('emp/vaccination',[VaccinationController::class, 'index'])->name('emp.vaccination');
Route::post('add/vaccination',[VaccinationController::class, 'store']);
Route::any('delete/vaccination',[VaccinationController::class, 'delete']);
Route::post('view/vaccination',[VaccinationController::class, 'view']);

Route::get('emp/wsq',[WsqController::class, 'index'])->name('emp.wsq');
Route::post('add/wsq',[WsqController::class, 'store']);
Route::any('delete/wsq',[WsqController::class, 'delete']);
Route::post('view/wsq',[WsqController::class, 'view']);

Route::post('add/education/certificates',[EmployeeDetailsController::class, 'store_education_certificates']);
Route::post('add/certificates',[EmployeeDetailsController::class, 'store_certificates']);
Route::post('add/bonus/certificates',[EmployeeDetailsController::class, 'store_bonus_certificates']);
Route::post('add/referal/certificates',[EmployeeDetailsController::class, 'store_referal_certificates']);
Route::post('add/vaccination/certificates',[EmployeeDetailsController::class, 'store_vaccination_certificates']);
Route::post('add/wsq/certificates',[EmployeeDetailsController::class, 'store_wsq_certificates']);
//leaves

Route::get('employee/leave',[LeaveController::class, 'index'])->name('emp.leave');
Route::get('leave/form',[LeaveController::class, 'add_leave_form'])->name('emp.leave.form');
Route::post('add/leave',[LeaveController::class, 'add_leave'])->name('add.leave');
Route::any('/change/leave/status',[LeaveController::class, 'change_leave_status']);
Route::any('/delete/leave/{id}', [LeaveController::class, 'delete_leave'])->name('delete.leave');
Route::any('/view/leave',[LeaveController::class, 'view_leave']); 
Route::any('leave/status',[LeaveController::class, 'leave_status'])->name('emp.leave.status');

//Route::get('salary',[PayrollController::class, 'index']);
Route::get('warning',[WarningController::class, 'index']); 
Route::get('warning/add/form', [WarningController::class, 'add_warning_form'])->name('warning.add.form') ;
Route::post('/store/warning',[WarningController::class, 'store'])->name('set.warning');
Route::post('/show/warning',[WarningController::class, 'show']);
Route::post('/delete/warning',[WarningController::class, 'destroy']);
//termination

Route::get('termination',[TerminationController::class, 'index']); 
Route::get('termination/add/form',[TerminationController::class, 'show_add_form'])->name('termination.add.form'); 
Route::post('add/termination',[TerminationController::class, 'store']);
Route::any('show/termination',[TerminationController::class, 'show']);
Route::any('delete/termination',[TerminationController::class, 'destroy']);
//payroll routes

Route::any('salary',[PayrollController::class, 'basic_salary'])->name('salary.list');
Route::any('add/salary/form',[PayrollController::class, 'add_salary_form']);
Route::any('add/salary',[PayrollController::class, 'store']);
Route::any('delete/salary',[PayrollController::class, 'destroy']);
Route::post('view/salary/details',[PayrollController::class, 'view']);
Route::any('edit/salary',[PayrollController::class, 'edit']);
Route::post('update/salary',[PayrollController::class, 'update']);
Route::get('make/payslip/{id}',[PayrollController::class, 'make_payslip'])->name('make.payslip');
Route::any('/payslip/history',[PayrollController::class, 'payroll_history'])->name('payslip.history');
Route::post('/status/change',[PayrollController::class, 'status_change']);

Route::get('emp/allowance',[PayrollController::class, 'allowance'])->name('emp.allowance');
Route::get('emp/incentive',[PayrollController::class, 'incentive'])->name('emp.incentive');
Route::get('emp/bonous',[PayrollController::class, 'bonous'])->name('emp.bonous');

});