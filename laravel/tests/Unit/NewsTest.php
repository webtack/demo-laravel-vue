<?php

namespace Tests\Unit;

use App\Models\ModelException;
use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\News;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class NewsTest extends TestCase {
	
	// use RefreshDatabase;
	
	protected $faker;
	
	protected function setUp(): void {
		parent::setUp(); // TODO: Change the autogenerated stub
		
		$this->faker = \Faker\Factory::create();
	}
	
	
	/**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreate()
    {
	    $news = News::create([
		    'title' => $this->faker->text(75),
		    'body' => $this->faker->text()
	    ]);
    	
        $this->assertTrue($news instanceof News, "News created successful");
    }
	
	/**
	 * A basic unit test example.
	 *
	 * @return void
	 */
	public function testUpdate()
	{
		$titleOrign = 'Title news';
		$titleUpdated = 'Title was updated';
		
		$news = News::create([
			'title' => $titleOrign,
			'body' => $this->faker->text()
		]);
		
		$news->update([
			'title' => $titleUpdated
		]);
		
		$id = $news->id;	
		
		$updatedNews = News::find($id);
		
		$this->assertTrue($updatedNews->title === $titleUpdated, "News updated successful");
	}
	
	/**
	 * @expectedException \App\Models\ModelException
	 */
	public function testUpdatingProtectedAgainstMassAssignmentProperty()
	{
		$news = News::create([
			'title' => $this->faker->text(75),
			'body' => $this->faker->text()
		]);
		
		$this->assertFalse($news->update([
			'uuid' => Str::uuid()
		]));
	}
	
	/**
	 * @return void
	 */
	public function testDeleting()
	{
		$news = News::create([
			'title' => $this->faker->text(75),
			'body' => $this->faker->text()
		]);
		
		$id = $news->id;
		$news->delete();
		
		$this->assertFalse(News::query()->where('id', $id)->exist());
	}
	
	/**
	 * @return void
	 */
	public function testAttachTags()
	{
		$news = News::first();
		
		$tagOneTitle = $this->faker->text(10);
		$tagOne = Tag::create([
			'name' => $tagOneTitle,
			'slug' => $tagOneTitle
		]);
		
		$tagTwoTitle = $this->faker->text(10);
		$tagTwo = Tag::create([
			'name' => $tagTwoTitle,
			'slug' => $tagTwoTitle
		]);
		
		$tagFirst = Tag::first();
		
		$tagUuids = [
			$tagOne->getAttribute('uuid'),
			$tagTwo->getAttribute('uuid'),
			$tagFirst->getAttribute('uuid')
		];
		
		$this->assertTrue($news->attachTags($tagUuids));
	}
}
