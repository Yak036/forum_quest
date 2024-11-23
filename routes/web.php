<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadController;
use App\Http\Livewire\ShowThread;
use App\Http\Livewire\ShowThreads;
use App\Http\Controllers\Auth\RegisteredUserController;
// use App\Models\Thread;
use Illuminate\Support\Facades\Route;



Route::get('/', ShowThreads::class)->name('dashboard');
Route::get('/my_threads', ShowThreads::class)->name('my_threads');

Route::get('/sobrenosotros', function () {
    return view('sobrenosotros');
})->name('sobrenosotros');

Route::get('/thread/{thread}', ShowThread::class)->middleware(['auth'])->name('thread');


Route::post('/personal_page_check', [RegisteredUserController::class, 'screenShot'])->name('personal_page_check');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('threads', ThreadController::class)->except(['show','index']);
});

require __DIR__.'/auth.php';
