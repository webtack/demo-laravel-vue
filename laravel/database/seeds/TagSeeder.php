<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $facker = \Faker\Factory::create();
	
	    for ($i = 0; $i < 5; $i++) {
	    	$name = $facker->text(25);
	    	
		    Tag::create([
			    'name' => 'Tag - ' . $name,
			    'slug' => Str::slug($name)
		    ]);
	    }
    }
}
