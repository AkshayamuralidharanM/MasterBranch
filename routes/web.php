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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::post('/', [EmployeeController::class, 'create']);
Route::get('employee.store', [EmployeeController::class,'store']);
Route::get('/fetch-employee', [EmployeeController::class, 'fetch_employee']);

Route::get('/edit_emp/{emp_id}', [EmployeeController::class,'edit_employee']);
Route::post('/update-emp/{emp_id}', [EmployeeController::class,'update_employee']);
// Route::get('', [EmployeeController::class,'']);      
  

 