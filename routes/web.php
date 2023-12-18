<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluationRequestController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/otp-verify', function () {
    return view('auth.verify-otp');
})->name('otp.verify');

Route::post('/otp-check', [AuthenticatedSessionController::class, 'checkOTP'])->name('otp.check');
Route::post('/otp-resend', [AuthenticatedSessionController::class, 'resendOTP'])->name('otp.resend');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/evaluation-requests', [EvaluationRequestController::class, 'index'])
        ->middleware('admin')
        ->name('evaluation-requests.index');
    Route::get('/request-evaluation', [EvaluationRequestController::class, 'create'])->name('evaluation-requests.create');
    Route::post('/request-evaluation', [EvaluationRequestController::class, 'store'])->name('evaluation-requests.store');
    Route::delete('/evaluation-requests/{evaluationRequest}', [EvaluationRequestController::class, 'destroy'])->name('evaluation-requests.destroy');


});

require __DIR__.'/auth.php';
