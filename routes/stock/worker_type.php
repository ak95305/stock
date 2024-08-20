<?php

use Illuminate\Support\Facades\Route;

Route::match(["get"], "worker-type","App\Http\Controllers\WorkerTypeController@index")->name("workerType.index");
Route::match(["get", "post"], "worker-type/add","App\Http\Controllers\WorkerTypeController@add")->name("workerType.add");
Route::match(["get", "post"], "worker-type/edit/{id}","App\Http\Controllers\WorkerTypeController@edit")->name("workerType.edit");
Route::match(["post"], "worker-type/status-change/{id}","App\Http\Controllers\WorkerTypeController@statusChange")->name("workerType.statusChange");
Route::match(["post"], "worker-type/delete/{id}","App\Http\Controllers\WorkerTypeController@delete")->name("workerType.delete");