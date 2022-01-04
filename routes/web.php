<?php

use App\Http\Controllers\LedgerController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//////_________________________Main company_______________________________
Route::get('/admin/maincompany','MainCompanyController@index')->name('maincompany');
Route::post('/admin/maincompany/add','MainCompanyController@store')->name('maincompany-add');
//////_________________________company_______________________________

Route::resource('company', 'ClientCompanyController');
Route::get('/admin/company','ClientCompanyController@index')->name('company');
Route::get('/admin/receivable','ClientCompanyController@account_receivable')->name('account_receivable');
Route::post('/admin/company/add','ClientCompanyController@store')->name('company-add');
Route::delete('/admin/company/delete/{id}','ClientCompanyController@destroy')->name('company-destroy');
Route::get('admin/company/details/{id}','ClientCompanyController@show')->name('company.details');
Route::get('admin/company/edit/{id}','ClientCompanyController@edit')->name('company.edit');
Route::put('company-update/{id}','ClientCompanyController@update')->name('company.update');

//------------------------------------Position---------------------------///////
Route::resource('position', 'PositionController');
Route::get('/admin/position','PositionController@index')->name('position');
Route::post('/admin/position/add','PositionController@store');
Route::delete('/admin/position/delete/{id}','PositionController@destroy');
Route::get('/admin/position/edit/{id}', 'PositionController@edit');
Route::put('/admin/position/update', 'PositionController@update');



/////___________________________________Payroll_______________________________
Route::resource('payroll', 'PayrollController');
Route::get('/admin/payroll','PayrollController@index')->name('payroll');
Route::get('/admin/payroll/position/{id}','PayrollController@getposition');
Route::get('/admin/payroll/employee/{id}','PayrollController@getemployee');
Route::get('/admin/payroll/salary/edit/{id}', 'PayrollController@salaryedit');
Route::put('/admin/payroll/salary/update', 'PayrollController@salaryupdate');
Route::post('/admin/payroll','PayrollController@store');


///////////____________________EMPLOYEE______________________//////////////

Route::resource('employees', 'EmployeeController');
Route::get('/admin/employees','EmployeeController@index')->name('employees');
Route::get('/admin/employees/position/{id}','EmployeeController@getPosition');
Route::post('/admin/employees/add','EmployeeController@store')->name('employee-add');
Route::delete('/admin/employees/delete/{id}','EmployeeController@destroy')->name('employee-destroy');
Route::get('admin/employees/edit/{id}','EmployeeController@edit')->name('employee.edit');
Route::put('employees-update/{id}','EmployeeController@update')->name('employee.update');
Route::get('admin/employees/details/{name}','EmployeeController@show')->name('employee.details');

///////////____________________Attendence______________________//////////////
// Route::get('/admin/attendence','AttendanceController@index')->name('attendence');
// Route::post('/admin/attendence/add','AttendanceController@store');

// Route::resource('companybalance', 'CompanyBalanceController');
Route::get('/admin/companybalance','CompanyBalanceController@index')->name('company.balance');
Route::post('/admin/companybalance/add','CompanyBalanceController@store');
Route::delete('/admin/companybalance/delete/{id}','CompanyBalanceController@destroy');
Route::get('/admin/companybalance/edit/{id}', 'CompanyBalanceController@edit')->name('company.blance.edit');


///////////____________________Bank Details______________________//////////////



Route::resource('bank', 'BankController');
Route::get('/admin/bank', 'BankController@index')->name('bank');
Route::post('/admin/bank/add', 'BankController@store')->name('bank-add');
Route::delete('/admin/bank/delete/{id}','BankController@destroy');
Route::get('/admin/bank/edit/{id}', 'BankController@edit')->name('bank.edit');
Route::put('/admin/bank/update', 'BankController@update')->name('bank.update');

Route::resource('bank/transaction', 'BankTransactionController');
Route::get('/admin/bank/transaction','BankTransactionController@index')->name('bank.transaction');
Route::get('/admin/bank/dropdown/{id}','BankTransactionController@bankaccount');
Route::post('/admin/bank/transaction','BankTransactionController@store')->name('transction.add');
Route::delete('/admin/bank/transaction/delete/{id}','BankTransactionController@destroy');


Route::resource('ledger', 'LedgerController');
Route::get('/admin/bank/ledger','LedgerController@index1')->name('ledger');
// Route::get('/admin/ledger1','LedgerController@index1')->name('ledger1');
Route::get('/admin/bank/ledger/details','LedgerController@genarateledger')->name('ledger1');
Route::get('/admin/company/ledger','LedgerController@companyledger')->name('company.ledger');
Route::get('/admin/company/ledger/details','LedgerController@genarate_company_ledger')->name('company.ledger.details');

Route::get('/admin/report','FinancialreportController@index');
Route::get('/bank/report/search','FinancialreportController@search')->name('search');
Route::get('/bank/report/details','FinancialreportController@search1');



Route::resource('rules','RulesController');
Route::get('/admin/rules','RulesController@index')->name('rules');
Route::post('/admin/rules/add', 'RulesController@store')->name('rules&policy');
Route::delete('/admin/rules/delete/{id}','RulesController@destroy');

Route::get('/admin/salarysheet','SalarySheetController@index')->name('salarysheet');
