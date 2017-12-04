<?php

namespace Modules\Shop\Contracts\Controllers\Frontend;

use Modules\Shop\Models\IProductCategory;

/**
 *
 * @author dinhtrong
 */
interface ICategoryController {
    public function __construct(IProductCategory $category);
}
