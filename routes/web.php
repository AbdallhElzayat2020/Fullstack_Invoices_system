<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
// invoices Route
Route::resource('/invoices', InvoicesController::class);
// sections Route
Route::resource('/sections', sectionsController::class);
// products Route
Route::resource('/products', ProductsController::class);
// section Route
Route::get('/section/{id}', [InvoicesController::class, "getproducts"]);
//InvoicesDetails Route
Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class, "edit"]);
// view invoice
Route::get("/View_file/{invoice_number}/{file_name}", [InvoicesDetailsController::class, "open_file"]);
// download invoice
Route::get("/download/{invoice_number}/{file_name}", [InvoicesDetailsController::class, "download_file"]);
// upload  new invoice
Route::resource("/InvoiceAttachments", InvoiceAttachmentsController::class);
// download invoice
Route::post("/delete_file", [InvoicesDetailsController::class, "destroy"])->name("delete_file");
// edit invoice
Route::get("/edit_invoice/{id}", [InvoicesController::class, "edit"]);



Route::get('/{page}', [AdminController::class, 'index']);
