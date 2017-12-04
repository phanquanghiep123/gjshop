<?php

namespace Modules\Shop\Database\Seeders;

use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Description of ProductCategoryTableSeederTrait
 *
 * @author dinhtrong
 */
trait ProductCategoryTableSeederTrait {

    public function run() {
        BaseModel::unguard();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $name = $faker->realText(10);
            $slug = \Illuminate\Support\Str::slug($name);
            $cat  = \Modules\Shop\Models\ProductCategory::create([
                        'name'   => $name,
                        'slug'   => $slug,
                        'status' => 1
            ]);
            for ($j = 0; $j < 3; $j++) {
                $childCatName = $faker->realText(10);
                $childCatSlug = \Illuminate\Support\Str::slug($childCatName);

                \Modules\Shop\Models\ProductCategory::create([
                    'name'      => $childCatName,
                    'slug'      => $childCatSlug,
                    'status'    => 1,
                    'parent_id' => $cat->id
                ]);
            }
        }
    }

}
