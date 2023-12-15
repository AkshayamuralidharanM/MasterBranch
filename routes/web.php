<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[EmployeeController::class,'index'])->name('mainPage');
Route::get('/create', [EmployeeController::class, 'create']);
Route::post('/employeestore', [EmployeeController::class,'store']);
Route::get('/fetch-employee', [EmployeeController::class, 'fetch_employee']);
Route::get('/getdesignation/{department_id}', [EmployeeController::class,'getdesignation'])->name('getdesignation');
Route::get('/getdepartment', [EmployeeController::class,'getdepartment'])->name('getdepartment');

Route::get('/edit_emp/{emp_id}', [EmployeeController::class,'edit_employee']);
Route::post('/update-emp', [EmployeeController::class,'update_employee']);
Route::get('/delete-emp/{emp_id}', [EmployeeController::class,'delete_employee']);

Route::get('/getDepartmentName/{id}', [EmployeeController::class, 'getDepartmentName']);
Route::get('/getDesignationName/{id}', [EmployeeController::class, 'getDesignationName']);
// Route::get('', [EmployeeController::class,'']);      
  

 