<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Mail\JobPosted;
use Illuminate\Support\Facades\Mail;

Route::get('test',function () {
    $job=\App\Models\Job::first();
    \App\Jobs\TranslateJob::dispatch($job);
    return 'Done';
});

Route::view('/','home');   

    Route::get('/jobs', [JobController::class,'index']);  
    Route::get('/jobs/create',[JobController::class,'create']);
    Route::get('/jobs/{job}', [JobController::class,'show']);
    Route::post('/jobs',[JobController::class,'store'])->middleware('auth');
    Route::get('/jobs/{job}/edit',[JobController::class,'edit'])->middleware('auth')->can('edit','job');
    Route::patch('/jobs/{job}', [JobController::class,'update']);
    Route::delete('/jobs/{job}', [JobController::class,'destroy']);

Route::resource('jobs',JobController::class)->middleware('auth');

Route::view('/contact','contact');

Route::get('/register',[RegisteredUserController::class,'create']);
Route::post('/register',[RegisteredUserController::class,'store']);

Route::get('/login',[SessionController::class,'create'])->name('login');    
Route::post('/login',[SessionController::class,'store']);
Route::post('/logout',[SessionController::class,'destroy']);