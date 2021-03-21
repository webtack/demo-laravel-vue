<?php

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$facker = \Faker\Factory::create();
    	
        for ($i = 0; $i < 10; $i++) {
        	News::create([
        		'title' => $facker->text(75),
        		'body' => $facker->text(500)
	        ]);
        }
    }
}
