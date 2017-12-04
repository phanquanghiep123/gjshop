<?php
/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */



/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */

Route::group(['middleware' => ['web']], function () {

    Route::auth();

    Route::get('/', ['uses' => 'PagesController@home']);

    // Pages routes
    if (Schema::hasTable(with(new App\Page)->getTable())) {
        foreach (App\Page::active()->select('slug')->get() as $page) {
            Route::get($page->slug, ['uses' => 'PagesController@show']);
        }
    }


    // Category routes
    if (Schema::hasTable(with(new App\Category)->getTable())) {

        $cats = App\Category::root()->get();

        foreach ($cats as $cat) {
            Route::get($cat->slug, ['uses' => 'CategoriesController@listFromRootCategory']);
            foreach ($cat->childs as $childCat) {
                Route::get($cat->slug . '/' . $childCat->slug, ['uses' => 'ArticlesController@listFromSubCategory']);
            }
        }
    }

    Route::get('search', [
        'uses' => 'SearchController@search',
        'as' => 'search'
    ]);

    Route::post('ajax-login', [
        'uses' => 'Auth\AuthController@ajaxLogin'
    ]);

    Route::post('register', [
        'uses' => 'Auth\AuthController@register', 'as' => 'register'
    ]);

    Route::post('password-reset', [
        'uses' => 'Auth\AuthController@password_reset', 'as' => 'password_reset'
    ]);

    Route::post('/newsletter', ['uses' => 'PagesController@newsletter_signup',
        'as' => 'newsletter'
    ]);

    Route::post('/cancel-signup', ['uses' => 'PagesController@cancel_signup',
        'as' => 'cancel_signup'
    ]);

    Route::post('/contact-us', ['uses' => 'PagesController@contact_us',
        'as' => 'contact_us'
    ]);

    Route::pattern('parentCategorySlug', '^(?!gjadmin|_debugbar|shop|elfinder)([a-zA-Z0-9-_]+)$');
    Route::pattern('categorySlug', '[a-zA-Z0-9-_]+');

    Route::get('articles/{cagegorySlug}/ajax-search', ['uses' => 'ArticlesController@ajaxSearch', 'as' => 'articles.ajaxSearch']);


    // Show Competition Information & Past Winners
    Route::get('competition/{slug}', ['uses' => 'CompetitionsController@show', 'as' => 'competitionDetail'])
        ->where('slug', '[a-zA-Z0-9-_]+');

    Route::get('tag/{slug}', ['uses' => 'PagesController@showTags', 'as' => 'showTags'])
        ->where('slug', '[a-zA-Z0-9-_]+');

    Route::post('/update-profile', ['uses' => 'PagesController@updateProfile',
        'as' => 'updateProfile']);

    Route::post('/delete-subscription', ['uses' => 'PagesController@delete_subscription',
        'as' => 'delete_subscription'
    ]);


    Route::post('/add-content-subscription', ['uses' => 'NotificationSubscriptionsController@add_content_subscription',
        'as' => 'add_content_subscription'
    ]);

    Route::post('delete-content-subscription', ['uses' => 'NotificationSubscriptionsController@delete_content_subscription',
        'as' => 'delete_content_subscription'
    ]);

    /************************
     *  Favourites
     * ********************** */

    Route::get('/favorite-articles', ['uses' => 'FavoriteArticlesController@index',
        'as' => 'get_favorite_article'
    ]);

    Route::post('/favorite-articles', ['uses' => 'FavoriteArticlesController@add',
        'as' => 'store_favorite_article'
    ]);

    Route::delete('/favorite-articles/{id}', ['uses' => 'FavoriteArticlesController@delete',
        'as' => 'remove_favorite_article'
    ]);

    /************************
     *  Genral account routes
     ************************/

    Route::get('account/overview', ['uses' => 'MyAccountController@my_account', 'as' => 'my_account', 'middleware' => ['auth']]);

    Route::get('account/edit', ['uses' => 'MyAccountController@edit_account', 'as' => 'edit_account', 'middleware' => ['auth']]);

    Route::get('account/subscriptions', ['uses' => 'MyAccountController@my_subscriptions', 'as' => 'my_subscriptions', 'middleware' => ['auth']]);

    Route::get('account/commissions', ['uses' => 'MyAccountController@my_commissions', 'as' => 'my_commissions', 'middleware' => ['auth']]);

    Route::get('account/add-referral', ['uses' => 'MyAccountController@add_referral', 'as' => 'add_referral', 'middleware' => ['auth']]);

    Route::post('account/save-referral', ['uses' => 'MyAccountController@save_referral', 'as' => 'save_referral', 'middleware' => ['auth']]);

    Route::get('account/referrals', ['uses' => 'MyAccountController@my_referrals', 'as' => 'my_referrals', 'middleware' => ['auth']]);

    Route::get('account/points-and-vouchers', ['uses' => 'MyAccountController@my_points', 'as' => 'my_points', 'middleware' => ['auth']]);

    Route::get('account/favorites', ['uses' => 'MyAccountController@my_favorites', 'as' => 'my_favorites', 'middleware' => ['auth']]);

    Route::get('account/order-history', ['uses' => '\Modules\Shop\Controllers\Frontend\OrderController@viewHistory', 'as' => 'viewHistory', 'middleware' => ['auth']]);  

    Route::get('account/order-{slug}', ['uses' => '\Modules\Shop\Controllers\Frontend\OrderController@orderDetails', 'as' => 'viewOrderDetails', 'middleware' => ['auth']]);  

    Route::post('/delete-address', ['uses' => 'MyAccountController@delete_address', 'as' => 'delete_address' ]);

    Route::post('/mark-default-address/{id}', ['uses' => 'MyAccountController@mark_default_address', 'as' => 'mark_default_address' ]);






    /* **************************  NEW ROUTES ************************** */

    Route::get('brand/{slug}', ['uses' => 'PagesController@view_brand', 'as' => 'viewBrand'])
        ->where('slug', '[a-zA-Z0-9-_]+');

    Route::get('news-item/{slug}', ['uses' => 'PagesController@news_item', 'as' => 'newsItem'])
        ->where('slug', '[a-zA-Z0-9-_]+');

    Route::get('articles/{categorySlug}', ['uses' => 'ArticlesController@listFromSubCategory', 'as' => 'articleCategory'])
        ->where('categorySlug', '[a-zA-Z0-9-_]+');

    Route::get('article/{categorySlug}/{slug}', ['uses' => 'ArticlesController@show', 'as' => 'detailtArticle'])
        ->where('slug', '[a-zA-Z0-9-_]+');

    // Show Competition Information & Past Winners
    Route::get('contributor/{slug}', ['uses' => 'ContributorsController@show', 'as' => 'contributorDetails'])
        ->where('slug', '[a-zA-Z0-9-_]+');

    /*     * *************************  END SECTION  *************************** */




    Route::group(['prefix' => 'gjadmin', 'middleware' => ['admin']], function () {

        Route::get('/', ['as' => 'dashboard',
            'uses' => 'Backend\BackendController@dashboard']);

        Route::get('site-settings', ['as' => 'site_settings',
            'uses' => 'Backend\BackendController@settings']);

        Route::get('update-settings', ['as' => 'update_settings',
            'uses' => 'Backend\BackendController@update_settings']);

        Route::post('article/add-product-related', ['uses' => 'Backend\ArticlesController@add_product_related_article', 
            'as' => 'gjadmin.product_related_article.add']);
        
        Route::get('article/delete-product-related/{product_id}/{id}', ['uses' => 'Backend\ArticlesController@delete_product_related_article', 
            'as' => 'gjadmin.product_related_article.delete'])
            ->where('slug', '[a-zA-Z0-9-_]+');

        Route::resource('users', 'Backend\UsersController');
        Route::resource('permissions', 'Backend\PermissionsController');
        Route::resource('permission-categories', 'Backend\PermissionsCategoriesController');
        Route::resource('roles', 'Backend\RolesController');
        Route::resource('articles', 'Backend\ArticlesController');
        Route::resource('article-categories', 'Backend\CategoriesController');
        Route::resource('quotes', 'Backend\QuotesController');
        Route::resource('tags', 'Backend\TagsController');
        Route::resource('news', 'Backend\NewsController');
        Route::resource('brands', 'Backend\BrandsController');
        Route::resource('retailers', 'Backend\RetailersController');
        Route::resource('slides', 'Backend\SlidesController');
        Route::resource('pages', 'Backend\CmspagesController');
        Route::resource('email-templates', 'Backend\EmailTemplatesController');
        Route::resource('subscribers', 'Backend\SubscribersController');
        Route::resource('faqs', 'Backend\FaqsController');
        Route::resource('postage-rates', 'Backend\PostageRatesController');
        Route::resource('couriers', 'Backend\CouriersController');
        Route::resource('faq-categories', 'Backend\FaqCategoriesController');
        Route::resource('vouchers', 'Backend\VouchersController');
        Route::resource('menus', 'Backend\MenusController');
        Route::resource('competitions', 'Backend\CompetitionController');
        Route::get('caches', ['uses' => 'Backend\CachingController@index', 'as' => 'gjadmin.caches.index']);
        Route::post('users/update-password', ['uses' => 'Backend\UsersController@update_password']);
        Route::post('caches/refresh-menu', ['uses' => 'Backend\CachingController@refreshMenuCaching', 'as' => 'gjadmin.caches.refreshMenu']);

    });
});


