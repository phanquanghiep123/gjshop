<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://nurturned.dev';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        putenv('DB_CONNECTION=sqlite');
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
    
    protected function setUp() {
        parent::setUp();
        if(!Schema::hasTable('article_category')){
            Artisan::call("migrate");
        }
        
    }

    protected function tearDown() {
        Artisan::call('migrate:reset');
        return parent::tearDown();
    }

}
