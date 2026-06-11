<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;

// Home route - shows welcome page
Route::get('/', function () {
    return view('welcome');
});

// Applicant routes - these are the CRUD operations
// Use Route::resource() for quick CRUD routes
Route::resource('applicants', ApplicantController::class);

// This creates the following routes automatically:
// GET    /applicants              -> ApplicantController@index (show all)
// GET    /applicants/create       -> ApplicantController@create (show create form)
// POST   /applicants              -> ApplicantController@store (save to database)
// GET    /applicants/{id}         -> ApplicantController@show (show details)
// GET    /applicants/{id}/edit    -> ApplicantController@edit (show edit form)
// PUT/PATCH /applicants/{id}      -> ApplicantController@update (update in database)
// DELETE /applicants/{id}         -> ApplicantController@destroy (delete from database)

