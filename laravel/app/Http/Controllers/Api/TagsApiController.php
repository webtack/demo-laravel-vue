<?php namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsApiController extends Controller {
	
	function list() {
		return response()->json([
			'items' => Tag::query()
				->orderByDesc('id')
				->get()
				->toArray()
		]);
	}
	
	function create(Request $request) {
		
		$data = $request->all();
		
		$tag = Tag::create($data);
		
		return response()->json([
			'message' => 'Created success',
			'item' => $tag->toArray()
		]);
	}
	
	function details($slug) {
		$item = Tag::query()
			->where('slug', $slug)
			->get()
			->first();
		
		$news = $item->news();
		
		return response()->json( [
			'item' => $item->toArray(),
			'news' => $news->toArray()
		]);
	}
	
	function exist($slug) {
		$item = Tag::query()
			->where('slug', $slug)
			->get()
			->first();
		
		return response()->json( [
			'item' => $item
		]);
	}
	
	function update(Request $request, $slug) {
		$data = $request->all();
		
		$item = Tag::query()
			->where('slug', $slug)
			->get()
			->first();
		
		$item->update($data);
		
		return response()->json([
			'message' => 'Updated success'
		]);
	}
	
	function delete($slug) {
		
		$item = Tag::query()
			->where('slug', $slug)
			->get()
			->first();
		
		$item->delete();
		
		return response()->json([
			'message' => 'Deleted success'
		]);
	}
}