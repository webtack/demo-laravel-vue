<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\News;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

$sparesponse = function(){
	return File::get(base_path() . '/public/spa/index.html');	
};

Route::get('spa/{path}', $sparesponse)->where(['path' => '.*']);


Route::get('/', function () {	
	return redirect()->route('news.list');
})->name('news.list');

Route::get('/news', function () {
	
    return view('news.list', [
    	'title' => 'News',
    	'items' => News::all()
    ]);
})->name('news.list');

Route::get('/news/tags', function () {
	return view('tags.list', [
		'title' => 'Tags',
		'items' => Tag::all()
	]);
})->name('tags.list');

Route::get('/news/{slug}', function ($slug) {	
	return view('news.item', [
		'item' => News::query()->where('slug', $slug)->get()->first()
	]);
})->name('news.item');

Route::get('/news/tags/{slug}', function ($slug) {
	// dd(Tag::query()->where('slug', $slug)->get());
	return view('tags.item', [
		'item' => Tag::query()->where('slug', $slug)->get()->first()
	]);
})->name('tags.item');
