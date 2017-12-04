<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
use lessc;

class LessCompiler extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assets:less';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'convert less to css';
    protected $files = [];
    protected $less;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->less = new lessc;
        $this->files = [
            public_path('assets/frontend/css/custom.'),
            public_path('modules/shop/css/styles.')
        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->files as $file) {
            try {
                $this->less->compileFile($file.'less',$file.'css');
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
        }
    }
}
