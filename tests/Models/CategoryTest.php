<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetRamdomQuotesDefaultNumber()
    {
        
        
        $faker = Faker\Factory::create();
        
        $child = $this->createChildCat();
        
        for ($i = 0;$i< 10;$i++){
            $quote = new App\Quote(['quote' => $faker->realText(100),'author'=> 'Trong']);
            $child->quotes()->save($quote);
        }
        
        $ramdomQuote = $child->getRamdomQuotes();
        
        $this->assertEquals(5, count($ramdomQuote));
    }
    
    public function testGetRamdomQuotesWhenTotalQuotesLessThanDefaultNumber(){
        $faker = Faker\Factory::create();
        
        $child = $this->createChildCat();
        
        for ($i = 0;$i< 3;$i++){
            $quote = new App\Quote(['quote' => $faker->realText(100),'author'=> 'Trong']);
            $child->quotes()->save($quote);
        }
        
        $ramdomQuote = $child->getRamdomQuotes();
        
        $this->assertEquals(3, count($ramdomQuote));
    }
    
    public function testGetRamdomQuotesWhenNumbeGreatThanTotalQuotes(){
        $faker = Faker\Factory::create();
        
        $child = $this->createChildCat();
        
        for ($i = 0;$i< 2;$i++){
            $quote = new App\Quote(['quote' => $faker->realText(100),'author'=> 'Trong']);
            $child->quotes()->save($quote);
        }
        
        $ramdomQuote = $child->getRamdomQuotes(6);
        
        $this->assertEquals(2, count($ramdomQuote));
    }


    private function createChildCat(){
        $root = App\Category::create([
            'name' => "Root Cat",
            'parent_id' => 0,
            'slug' => "root-cat",
        ]);
        
        $child = App\Category::create([
            'name' => 'Child Cat',
            'parent_id' => $root->id,
            'slug' => 'child-cat'
        ]);
        return $child;
    }
}
