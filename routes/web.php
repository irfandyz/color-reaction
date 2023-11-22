<?php

use Illuminate\Support\Facades\Route;
use App\Models\Score;
use App\Models\User;
use App\Models\Setting;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('signin');
});
Route::get('/sign-up', function () {
    return view('signup');
});
Route::middleware(['user'])->group(function () {
    Route::get('/user', function () {
        $setting = Setting::first();
        return view('user.index',compact('setting'));
    });
    
});
Route::middleware(['admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', 'index');
        Route::get('/admin/setting', 'setting');
        Route::post('/admin/saveSetting', 'saveSetting');
        Route::get('admin/export/{id}', 'export');
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/logout', 'logout');
    Route::post('/sign-in', 'login');
    Route::post('/sign-up', 'store');
});
Route::get('/leaderboard', function () {
    $data = Score::orderBy('average','asc')->get();
        $one = [];
        $three = [];
        $five = [];
        foreach ($data as  $value) {
            $value->score = json_decode($value->score);
            if (count($value->score) == 5) {
                array_push($five,$value);
            }
            if (count($value->score) == 3) {
                array_push($three,$value);
            }
            if (count($value->score) == 1) {
                array_push($one,$value);
            }
        }
        $data = [
            'one'=>$one,
            'three'=>$three,
            'five'=>$five,
        ];
    return view('leaderboard',compact('data'));
});
