<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
*/
// 仕事カテゴリ マスタ
Route::group(['prefix' => 'job_categories'], function () {
    Route::get('/', [Controllers\Api\Master\JobCategoryController::class, 'list']);
});