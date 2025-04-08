<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;

//all listing
Route::get('/',[ListingController::class,'index']);
// Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

Route::get('/listings/create',[ListingController::class,'create'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');
//Manage LIstings
Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');
// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//Show register Create Form
Route::get('/register',[UserController::class,'create'])->middleware('guest');

//add new user
Route::get('/users',[UserController::class,'store']);

//log user out
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');
//show login form
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');

//user login form
Route::post('/users/authenticate',[UserController::class,'authenticate']);
//show create form

//  listing store data
// Route::post('/listings',[ListingController::class,'store']);

// Route::get('/listings/create',[ListingController::class,'create']);
// //show Edit Form
// Route::get('/listings/{listing}/edit',[ListingController::class,'edit']);

// // update listings
// Route::put('/listings/{listing}',[ListingController::class,'update']);

// // Delete LIstings
// Route::delete('/listings/{listing}',[ListingController::class,'delete']);
 
// //single listing
// Route::get('/listings/{listing}/show',[ListingController::class,'show']);
