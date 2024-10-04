<?php

use Illuminate\Support\Facades\Route;

Route::get("/", [ \App\Http\Controllers\HomeController::class, "index" ])->name("home");
Route::get("/book/create", [ \App\Http\Controllers\HomeController::class, "create" ])->name("home.create");

Route::post("/book", [ \App\Http\Controllers\HomeController::class, "store" ])->name("home.store");

Route::get("/book/{id}/delete", [ \App\Http\Controllers\HomeController::class, "destroy" ])->name("home.delete");
Route::get("/book/{id}/edit", [ \App\Http\Controllers\HomeController::class, "edit" ])->name("home.edit");
Route::post("/book/{id}", [ \App\Http\Controllers\HomeController::class, "update" ])->name("home.update");