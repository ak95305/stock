<?php

use Illuminate\Support\Facades\Route;

Route::match(["get"], "lot","App\Http\Controllers\LotController@index")->name("lot.index");
Route::match(["get", "post"], "lot/add","App\Http\Controllers\LotController@add")->name("lot.add");
Route::match(["get", "post"], "lot/edit/{id}","App\Http\Controllers\LotController@edit")->name("lot.edit");
Route::match(["post"], "lot/status-change/{id}","App\Http\Controllers\LotController@statusChange")->name("lot.statusChange");
Route::match(["post"], "lot/delete/{id}","App\Http\Controllers\LotController@delete")->name("lot.delete");
Route::match(["post"], "lot/change-status/{id}","App\Http\Controllers\LotController@changeStatus")->name("lot.changeStatus");