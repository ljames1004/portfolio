<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('portfolio.index');
})->name('home');

Route::get('/contact', function () {
    return view('contact.index');
})->name('contact');
