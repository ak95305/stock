<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "App\Http\Controllers\HomeController@index")->name("home");

include "stock/lot.php";
include "stock/party.php";
