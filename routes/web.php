<?php

use Controller\Site;
use Src\Route;

Route::add('go', [Site::class, 'index']);
Route::add('hello', [Site::class, 'hello']);