<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect()->route('contacts.index');
// });

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit'); // Add this line
Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update'); // Add this for updating

Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy'); // For deleting

Route::post('/contacts/import-xml', [ContactController::class, 'importXML'])->name('contacts.importXML');



// Route::resource('contacts', ContactController);
