<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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



Route::get('/home',[HomeController::class,'home']);
Route::get('/',[HomeController::class,'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['admin']) -> group(function(){
    Route::get('/add_doctors_view',[AdminController::class,'add_doctors_view']);
    Route::post('/upload_doctor',[AdminController::class,'upload']);
    Route::get('/view_appointments',[AdminController::class,'view_appointment']);
    Route::get('/approve_appointment/{appointment_id}',[AdminController::class,'approve_appointment'])->name('approve');
    Route::get('/cancel_appointment/{appointment_id}',[AdminController::class,'cancel_appointment'])->name('cancel');
    Route::get('/view_doctors',[AdminController::class,'view_doctors']);
    Route::get('/update_doctor/{doctor_id}',[AdminController::class,'doctor_update'])->name('update_doctor');
    Route::post('/edit_doctor/{doctor_id}',[AdminController::class,'edit_doctor'])->name('edit_doctor');
    Route::get('/delete_doctor/{doctor_id}',[AdminController::class,'delete_doctor'])->name('delete_doctor');
    Route::get('/view_mail/{appointment_id}',[AdminController::class,'view_mail'])->name('Email_view');
    Route::post('/send_mail/{appointment_id}',[AdminController::class,'send_mail'])->name('sendMail');

});

Route::post('/appointment',[HomeController::class,'appointment']);
Route::get('/myappointments/{user_id}',[HomeController::class,'view_appointments'])->middleware('auth')->name('myappointments');
Route::get('/cancel_appointment/{id}',[HomeController::class,'delete_appointment'])->name('cancel_appointment');

