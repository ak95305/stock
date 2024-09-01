<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "App\Http\Controllers\HomeController@index")->name("home");
Route::view("/home", "home.index_");

include "stock/lot.php";
include "stock/party.php";
include "stock/worker_type.php";
include "stock/worker.php";
include "stock/assign_lot.php";
