<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::prefix('admin')->middleware(['auth' , 'role:admin'])->group(function(){
    Route::get('/dashboard' , [AdminController::class , 'dashboard'])->name('admin.dashboard');
    // employee
    Route::get('/employee' , [AdminController::class , 'showEmployee'])->name('admin.employee');
    Route::post('/employee' , [AdminController::class , 'createEmployee'])->name('admin.createEmployee');
    Route::get('/employee/{employee}' , [AdminController::class , 'editEmployee'])->name('admin.editEmployee');
    Route::put('/employee/{employee}' , [AdminController::class , 'updateEmployee'])->name('admin.updateEmployee');
    Route::delete('/employee/{employee}' , [AdminController::class , 'destroyEmployee'])->name('admin.destroyEmployee');
    Route::get('/trashed/employee' , [AdminController::class, 'trashedEmployee'])->name('admin.trashedEmployee');
    Route::put('/trashed/employee/{employee}' , [AdminController::class, 'restoreEmployee'])->name('admin.restoreEmployee');
    Route::delete('/trashed/employee/{employee}' , [AdminController::class, 'forceDeleteEmployee'])->name('admin.forcedeleteEmployee');
    //leave type
    Route::get('/leavetype' , [AdminController::class , 'showLeaveType'])->name('admin.leaveType');
    Route::post('/leavetype' , [AdminController::class , 'createLeaveType'])->name('admin.createLeaveType');
    Route::get('/leavetype/{leavetype}' , [AdminController::class , 'editLeaveType'])->name('admin.editLeaveType');
    Route::put('/leavetype/{leavetype}' , [AdminController::class , 'updateLeaveType'])->name('admin.updateLeaveType');
    Route::delete('/leavetype/{leavetype}' , [AdminController::class , 'destroyLeaveType'])->name('admin.destroyLeaveType');
    Route::put('/leave-requests/{id}/approve', [AdminController::class, 'approve'])->name('leave-requests.approve');
    Route::put('/leave-requests/{id}/deny', [AdminController::class, 'deny'])->name('leave-requests.deny');
    Route::get('/trashed/leavetype' , [AdminController::class, 'trashedType'])->name('admin.trashedType');
    Route::put('/trashed/leavetype/{leavetype}' , [AdminController::class, 'restoreType'])->name('admin.restoreType');
    Route::delete('/trashed/leavetype/{leavetype}' , [AdminController::class, 'forceDeleteType'])->name('admin.forcedeleteType');
});

Route::prefix('employee')->middleware(['auth' , 'role:employee'])->group(function(){
    Route::get('/dashboard' , [EmployeeController::class , 'dashboard'])->name('employee.dashboard');
    Route::post('/leaverequest' , [EmployeeController::class , 'createLeaveRequest'])->name('employee.createLeaveRequest');
    Route::get('/leaverequest/{leaveRequest}', [EmployeeController::class, 'editLeaveRequest'])->name('employee.editLeaveRequest');
    Route::put('/leaverequest/{leaveRequest}', [EmployeeController::class, 'updateLeaveRequest'])->name('employee.updateLeaveRequest');
    Route::delete('/leaverequest/{leaveRequest}', [EmployeeController::class, 'destroyLeaveRequest'])->name('employee.destroyLeaveRequest');
    Route::get('/trashed/leaverequest' , [EmployeeController::class, 'trashedRequest'])->name('employee.trashedRequest');
    Route::put('/trashed/leaverequest/{leaverequest}' , [EmployeeController::class, 'restoreRequest'])->name('employee.restoreRequest');
    Route::delete('/trashed/leaverequest/{leaverequest}' , [EmployeeController::class, 'forceDeleteRequest'])->name('employee.forcedeleteRequest');
});
