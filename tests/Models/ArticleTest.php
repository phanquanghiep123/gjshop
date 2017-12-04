<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Article;
use App\Category;
use App\User;

class ArticleTest extends TestCase {

    public function testRelatedArticles() {
        $this->createArticles(10);
        
        $article = Article::first();
        
        $articleCatIDs = $article->categories()->lists('id')->toArray();
        
        $related = $article->getRelatedArticles();
        
        $result = true;
        
        foreach ($related as $a){
            $aCatIDs = $a->categories()->lists('id')->toArray();
            $check = array_intersect($articleCatIDs, $aCatIDs);
            if(!count($check)){
                $result = false;
            }
        }
        $this->assertTrue($result);
    }

    private function createArticles($perCat) {
        $faker = Faker\Factory::create();

        $user = App\User::create(array(
                    "f_name"   => $faker->firstName,
                    "l_name"   => $faker->lastName,
                    "email"    => $faker->email,
                    "password" => Hash::make("123")
        ));

        for ($i = 0; $i < 2; $i++) {
            $cat   = App\Category::create([
                        'name'      => "Cat" . ($i + 1),
                        'parent_id' => 0,
                        'slug'      => "cat-" . ($i + 1),
            ]);
            $title = $faker->realText(100);

            $articleIDs = [];

            for ($j = 0; $j < $perCat; $j++) {
                $article = App\Article::create([
                            'title'            => $faker->realText($title),
                            'meta_keywords'    => 'meta keywords',
                            'meta_description' => 'meta description',
                            'content'          => $faker->realText(500),
                            'slug'             => Illuminate\Support\Str::slug($title),
                            'status'           => App\Article::APPROVED,
                            'post_date'        => date('Y-m-d'),
                            'user_id'          => $user->id
                ]);

                $articleIDs[] = $article->id;
            }

            $cat->articles()->sync($articleIDs);
        }
    }

}
