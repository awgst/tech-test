<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::group(['prefix' => 'student'], function () {
        Route::get('index', App\Livewire\Student\Index::class)->name('student.index');
        Route::get('create', App\Livewire\Student\Create::class)->name('student.create');
        Route::get('edit/{id}', App\Livewire\Student\Edit::class)->name('student.edit');
        Route::get('show/{id}', App\Livewire\Student\Show::class)->name('student.show');
    });
});

require __DIR__.'/auth.php';
