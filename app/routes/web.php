<?php

use App\Http\Controllers\CaseFileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return redirect()->route('cases.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cases', [CaseFileController::class, 'index'])->name('cases.index');
    Route::post('/cases', [CaseFileController::class, 'store'])->name('cases.store');

    Route::get('/cases/{caseFile}', [CaseFileController::class, 'show'])->name('cases.show');
    Route::post('/cases/{caseFile}/subject', [CaseFileController::class, 'storeSubject'])->name('cases.subject.store');
    Route::post('/cases/{caseFile}/aliases', [CaseFileController::class, 'storeAlias'])->name('cases.aliases.store');
    Route::post('/cases/{caseFile}/addresses', [CaseFileController::class, 'storeAddress'])->name('cases.addresses.store');
    Route::post('/cases/{caseFile}/relatives', [CaseFileController::class, 'storeRelative'])->name('cases.relatives.store');
});

require __DIR__.'/auth.php';
