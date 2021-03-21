<?php

use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\TagsApiController;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'news'], function () {
	Route::get('/list', [NewsApiController::class, 'list'])->name('api.news.list');	
	Route::put('/create', [NewsApiController::class, 'create'])->name('api.news.create');	
	Route::get('{slug}', [NewsApiController::class, 'details'])->name('api.news.details');	
	Route::post('{slug}/update', [NewsApiController::class, 'update'])->name('api.news.update');	
	Route::delete('{slug}/delete', [NewsApiController::class, 'delete'])->name('api.news.delete');	
});

Route::group(['prefix' => 'tags'], function () {	
	Route::get('list', [TagsApiController::class, 'list'])->name('api.tags.list');	
	Route::put('/create', [TagsApiController::class, 'create'])->name('api.tags.create');	
	Route::get('{slug}', [TagsApiController::class, 'details'])->name('api.tags.details');	
	Route::get('{slug}/exist', [TagsApiController::class, 'exist'])->name('api.tags.exist');	
	Route::post('{slug}/update', [TagsApiController::class, 'update'])->name('api.tags.update');	
	Route::delete('{slug}/delete', [TagsApiController::class, 'delete'])->name('api.tags.delete');	
});


