<?php

use Illuminate\Support\Facades\Route;

Route::match(["get"], "stock","App\Http\Controllers\LotController@index")->name("lot.index");
Route::match(["get", "post"], "stock/add","App\Http\Controllers\LotController@add")->name("lot.add");
Route::match(["get", "post"], "stock/edit/{id}","App\Http\Controllers\LotController@edit")->name("lot.edit");
Route::match(["post"], "stock/status-change/{id}","App\Http\Controllers\LotController@statusChange")->name("lot.statusChange");
Route::match(["post"], "stock/delete/{id}","App\Http\Controllers\LotController@delete")->name("lot.delete");