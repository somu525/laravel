<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

//home
Route::get('/', function () {
    return view('home');
});
//index
Route::get('/jobs', function ()  {
    $jobs= Job::with('employer')->latest()->simplePaginate(3); 
    return view('jobs.index',['jobs'=>$jobs]);
});
//create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});
//show
Route::get('/jobs/{id}', function ($id) {
    $job=Job::find($id);
    return view('jobs.show',['job'=>$job]);
});
//store
Route::post('/jobs',function() {
    request()->validate([
        'title'=>['required','min:3'],
        'salary'=>['required']

    ]);
    Job::create([
        'title'=>request('title'),
        'salary'=>request('salary'),
        'employer_id'=>1
    ]);
    return redirect('/jobs');
});
//edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job=Job::find($id);
    return view('jobs.edit',['job'=>$job]);
});
//update
Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title'=>['required','min:3'],
        'salary'=>['required']

    ]);
    $job=Job::findOrFail($id);
    $job->update([
        'title'=>request('title'),
        'salary'=>request('salary')
    ]);
    return redirect('/jobs/'.$job->id);
});
//delete
Route::delete('/jobs/{id}', function ($id) {
    $job=Job::findOrFail($id);
    $job->delete();
    return redirect('/jobs');
});
//contact
Route::get('/contact', function () {
    return view('contact');
});
