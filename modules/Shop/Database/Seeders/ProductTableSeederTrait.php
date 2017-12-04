<?php

namespace Modules\Shop\Database\Seeders;

use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Description of ProductTableTrait
 *
 * @author dinhtrong
 */
trait ProductTableSeederTrait {

    public function run() {
        BaseModel::unguard();

        $path  = 'engine/shop/demo/';
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 300; $i++) {

            $name   = $faker->realText(20);
            $images = [
                $path . 's1.jpg', $path . 's2.jpg', $path . 's3.jpg'
            ];

            \Modules\Shop\Models\Product::create([
                'name'          => $name,
                'slug'          => \Illuminate\Support\Str::slug($name),
                'images'        => $images,
                'list_image'    => $path . 's0.jpg',
                'content'       => $faker->realText(500),
                'is_featured'   => ($i % 10 == 0) ? true : false,
                'regular_price' => rand(10, 100),
                'weigh'        => rand(100, 2000)
            ]);
        }

        $arrayService = new \App\Services\ArrayRamdomService(
                \Modules\Shop\Models\Product::lists('id')->toArray());

        foreach (\Modules\Shop\Models\ProductCategory::where('parent_id', '!=', 0)->get() as $cat) {
            $subProductIds = $arrayService->ramdomSubArray(40);
            $cat->products()->sync($subProductIds);
        }
    }

}
