<?php

use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StopsController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\NoteController;

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



Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('trips', TripController::class)->parameters(['trips' => 'trip:id']);
        // route del garbage
        Route::get('/garbage', [TripController::class, 'indexDeleted'])->name('garbage');
        Route::group(['prefix' => 'garbage'], function () {
            Route::post('/{trip}/restore', [TripController::class, 'restore'])->name('garbages.restore');
            Route::post('/restore-all', [TripController::class, 'restoreAll'])->name('garbages.restoreall');
            // Route::delete('/{trip}/force', [TripController::class, 'forceDelete'])->name('garbages.forcedelete');
        });

        Route::get('/stops/create/{trip_id}', [StopsController::class, 'create'])->name('stops.create');
        Route::post('/stops', [StopsController::class, 'store'])->name('stops.store');
        Route::get('/stops/{id}', [StopsController::class, 'show'])->name('stops.show');
        Route::get('/stops/{trip_id}', [StopsController::class, 'index'])->name('stops.index');
        Route::get('/stops/{id}/edit', [StopsController::class, 'edit'])->name('stops.edit');
        Route::put('/stops/{id}', [StopsController::class, 'update'])->name('stops.update');
        Route::delete('/destroy/{id}', [StopsController::class, 'destroy'])->name('stops.destroy');

        // rotta note 
        Route::resource('notes', NoteController::class)->parameters(['notes' => 'note:id']);
        Route::post('/admin/notes', [NoteController::class, 'store'])->name('admin.notes.store');
        // delete valutazione tappa 
        Route::delete('notes/{noteId}', [NoteController::class, 'destroyByStop'])->name('notes.destroy');



        // rotta rating 
        Route::resource('ratings', RatingController::class)->parameters(['ratings' => 'rating:id']);
        // delete valutazione tappa 
        Route::delete('/stops/{stopId}/rating', [RatingController::class, 'destroyByStop'])->name('stops.rating.destroy');

    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
