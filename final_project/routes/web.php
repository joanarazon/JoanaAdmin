<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;


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
Route::get('admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware(['auth','admin']);
Route::get('/admin', function () {
    return view('admin/dashboard');
})->name('admin');
Route::get('/accountmanagement', [AdminController::class, 'showAccountManagement'])
    ->name('accountmanagement');
Route::post('/updateAccount/{id}', [AdminController::class, 'updateAccount'])->name('updateAccount');
Route::post('/deleteAccount/{id}', [AdminController::class, 'deleteAccount'])->name('deleteAccount');
Route::get('/showLogin', [AuthenticatedSessionController::class, 'create'])
    ->name('showLogin');
Route::middleware('guest')->group(function () {
Route::get('registerView', [RegisteredUserController::class, 'create'])
                ->name('registerView');
Route::post('registerButton', [RegisteredUserController::class, 'store'])
              ->name('registerButton');
Route::get('createWorkspace', [AdminController::class, 'showUserDashboard'])
              ->name('createWorkspace');
});


