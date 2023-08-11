<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeePageController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\ProfileController;
use App\Models\LeaveRequest;
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
Route::get('/dashboard', function () {
    return view('welcome');
});
Route::prefix('employee')->group(function(){
    Route::get('/login' , [EmployeePageController::class , 'loginForm'])->name('login_form');
    Route::post('/login' , [EmployeePageController::class , 'login'])->name('employee.login');
    Route::get('/register' , [EmployeePageController::class , 'registerForm']);
    Route::post('/register' , [EmployeePageController::class , 'register'])->name('employee.register');
});
Route::prefix('employee')->middleware(['auth','employee'])->group(function(){
    Route::get('/dashboard' , [EmployeePageController::class , 'index'])->name('employee.dashboard');
    Route::post('leaveRequest' , [LeaveRequestController::class , 'store'])->name('leaveRequest.store');
    Route::put('leaveRequest/{leaveRequest}' , [LeaveRequestController::class , 'update'])->name('leaveRequest.update');
    Route::delete('leaveRequest/{leaveRequest}' , [LeaveRequestController::class , 'destroy'])->name('leaveRequest.destroy');
    Route::get('leaveRequest/{leaveRequest}/edit' , [LeaveRequestController::class , 'edit'])->name('leaveRequest.edit'); 
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth','web'])->group(function () {
    Route::get('/dashboard', [AuthenticatedSessionController::class , 'index'])->name('admin.dashboard');
    Route::resources([
        'employee' => EmployeeController::class,
        'leavetype' => LeaveTypeController::class,
    ]);
    Route::get('leaveRequest' , [LeaveRequestController::class , 'index'])->name('leaveRequest.index');
});



require __DIR__.'/auth.php';
