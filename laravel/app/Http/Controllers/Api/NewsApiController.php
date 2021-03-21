<?php namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsApiController extends Controller {

	function list() {
		return response()->json([
			'items' => News::query()
				->orderByDesc('id')
				->get(['id', 'slug', 'title'])
				->toArray()
		]);
	}
	
	function create (Request $request) {
		
		$data = $request->all();
		
		$news = News::create($data['item']);
		
		return response()->json([
			'message' => 'Created success'
		]);
	}
	
	function details($slug) {
		$item = News::query()
			->where('slug', $slug)
			->get()
			->first();
		
		$tags = $item->tags();
		
		
		return response()->json([
			'item' => $item->toArray(),
			'tags' => $tags->toArray()
		]);
	}
	
	function update(Request $request, $slug) {
		$data = $request->all();
		
		$item = News::query()
			->where('slug', $slug)
			->get()
			->first();
		
		DB::transaction(function () use ($item, $data) {
			$item->update($data['item']);			
			$tagUuids = collect($data['tags'])->pluck('uuid')->all();
			$item->attachTags($tagUuids);
		});
		
		return response()->json([
			'message' => 'Updated success'
		]);
	}
	
	function delete($slug) {
		
		$item = News::query()
			->where('slug', $slug)
			->get()
			->first();
		
		$item->delete();
		
		return response()->json([
			'message' => 'Deleted success'
		]);
	}
	
}