<?php

use App\Models\News;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class NewsTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (News::all() as $item) {
        	$uuids = Tag::query()
		        ->inRandomOrder()
		        ->limit(3)
		        ->get()
		        ->transform(function ($item) { return $item->uuid;})
		        ->all();
        	
        	if($item instanceof News) {
        		$item->attachTags($uuids);
	        }
        }
    }
}
