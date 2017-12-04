<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class InitFolder extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:folder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init folder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->createResourcesUsersFolder();
        $this->createPublicUploadsFolder();
        $this->createPublicTmpFolder();
    }

    private function createResourcesUsersFolder() {
        $path = resource_path('users');
        if (!File::exists($path)) {
            File::makeDirectory($path);
            $this->info($path . ' has been created');
        }
        $parentPullPath = resource_path();
        exec("cd $parentPullPath;sudo chmod g+rwxs users/");
        $this->info(resource_path('users') . ' has been set writeable');
    }
    
    private function createPublicUploadsFolder(){
        $path = public_path('uploads');
        if (!File::exists($path)) {
            File::makeDirectory($path);
            $this->info($path . ' has been created');
        }
        $parentPullPath = public_path();
        exec("cd $parentPullPath;sudo chmod g+rwxs uploads/");
        $this->info($path . ' has been set writeable');
    }
    
    private function createPublicTmpFolder(){
        $path = public_path('.tmp');
        if (!File::exists($path)) {
            File::makeDirectory($path);
            $this->info($path . ' has been created');
        }
        $parentPullPath = public_path();
        exec("cd $parentPullPath;sudo chmod g+rwxs .tmp/");
        $this->info($path . ' has been set writeable');
    }

}
