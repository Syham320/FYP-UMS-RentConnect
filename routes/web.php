<?php

use Illuminate\Support\Facades\Route;

//landing page

Route::get('/', function () {
    return view('landing');
});

// in routes/web.php

Route::get('/login', function () {
    return "Login Page Coming Soon";
})->name('login');

Route::get('/register', function () {
    return "Register Page Coming Soon";
})->name('register');
