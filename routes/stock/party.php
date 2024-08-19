<?php

use Illuminate\Support\Facades\Route;

Route::match(["get"], "party","App\Http\Controllers\PartyController@index")->name("party.index");
Route::match(["get", "post"], "party/add","App\Http\Controllers\PartyController@add")->name("party.add");
Route::match(["get", "post"], "party/edit/{id}","App\Http\Controllers\PartyController@edit")->name("party.edit");
Route::match(["post"], "party/status-change/{id}","App\Http\Controllers\PartyController@statusChange")->name("party.statusChange");
Route::match(["post"], "party/delete/{id}","App\Http\Controllers\PartyController@delete")->name("party.delete");