<?php

use Illuminate\Support\Facades\Route;

Route::match(["get"], "worker","App\Http\Controllers\WorkerController@index")->name("worker.index");
Route::match(["get", "post"], "worker/add","App\Http\Controllers\WorkerController@add")->name("worker.add");
Route::match(["get", "post"], "worker/edit/{id}","App\Http\Controllers\WorkerController@edit")->name("worker.edit");
Route::match(["post"], "worker/status-change/{id}","App\Http\Controllers\WorkerController@statusChange")->name("worker.statusChange");
Route::match(["post"], "worker/delete/{id}","App\Http\Controllers\WorkerController@delete")->name("worker.delete");