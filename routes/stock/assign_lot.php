<?php

use Illuminate\Support\Facades\Route;

// Route::match(["get"], "lot", "App\Http\Controllers\LotController@index")->name("lot.index");
Route::match(["get", "post"], "assign-lot/add","App\Http\Controllers\AssignLotController@add")->name("assignLot.add");
Route::match(["get", "post"], "assign-lot/get-lot-assign-info/{id?}","App\Http\Controllers\AssignLotController@getLotAssignInfo")->name("assignLot.getLotAssignInfo");
Route::match(["get", "post"], "assign-lot/edit/{lotId}","App\Http\Controllers\AssignLotController@edit")->name("assignLot.edit");
// Route::match(["post"], "lot/status-change/{id}","App\Http\Controllers\LotController@statusChange")->name("lot.statusChange");
// Route::match(["post"], "lot/delete/{id}","App\Http\Controllers\LotController@delete")->name("lot.delete");