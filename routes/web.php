<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('home.index', ['schedules' => Schedule::all()]);
})->name('home.index');

Route::get('/dashboard', function () {

    updateOnlineUsers();

    if (Auth::check() && Auth::user()->is_doctor) {
        return view('schedule.index', [
            'schedules' => Schedule::withCount('appointment')->get()
        ]);
    } else if (!Auth::user()->is_doctor) {
        return view('dashboard.patient-dashboard', [
            'schedules' => Schedule::withCount('appointment')->get()
        ]);
    }
})->name('dashboard')->middleware('auth');

Route::resource('schedule', ScheduleController::class);

Route::resource('appointment', AppointmentController::class)->except('create', 'store');
Route::post('/appointment/{scheduleId}', [AppointmentController::class, 'store'])->name('appointment.store');
Route::get('/appointment/create/{scheduleId}', [AppointmentController::class, 'create'])->name('appointment.create');

Route::prefix('/profile')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
});
Route::get('/patients', [UserController::class, 'index'])->name('user.index');

function updateOnlineUsers()
{
    $sessionId = session()->getId();
    $counterKey = 'online-users-counter';
    $userskey = 'online-users';

    $users = Cache::get($userskey, []);
    $updatedUsers = [];
    $difference = 0;
    $now = now();

    //To Update The List Of Online Users
    foreach ($users as $session => $lastVisitedTime) {
        if ($now->diffInMinutes($lastVisitedTime) < 1) {
            $updatedUsers[$session] = $lastVisitedTime;
        } else {
            $difference--;
        }
    }

    //Check For Status of Current Authenticated User
    if (!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= 1) {
        $difference++;
    }

    $updatedUsers[$sessionId] = $now;

    Cache::forever($userskey, $updatedUsers);
    if (!Cache::has($counterKey)) {
        Cache::forever($counterKey, 1);
    } else {
        Cache::increment($counterKey, $difference);
    }
}
