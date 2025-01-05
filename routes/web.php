<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ContactController;
use App\Http\Livewire\ShowThread;
use App\Http\Livewire\ShowThreads;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Livewire\Register;
// use App\Models\Thread;
use Illuminate\Support\Facades\Route;




Route::get('/sobrenosotros', function () {
    return view('sobrenosotros');
})->name('sobrenosotros');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contactSend');


Route::get('/', ShowThreads::class)->name('dashboard');
Route::get('/my_threads', ShowThreads::class)->name('my_threads');



Route::get('/thread/{thread}', ShowThread::class)->middleware(['auth'])->name('thread');

Route::get('/register', Register::class)->name('register');


Route::post('/personal_page_check', [RegisteredUserController::class, 'screenShot'])->name('personal_page_check');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('threads', ThreadController::class)->except(['show','index']);
});

require __DIR__.'/auth.php';
