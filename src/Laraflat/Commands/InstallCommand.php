<?php

namespace Laraflat\Laraflat\Laraflat\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

use Illuminate\Support\Facades\Artisan;
use Laraflat\Laraflat\Laraflat\Models\Module;


class InstallCommand extends Command
{

    protected $DS = DIRECTORY_SEPARATOR;

    protected $filesystem;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laraflat:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Laraflat';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        Artisan::call('migrate');


        Artisan::call('storage:link');


        $path = base_path('database'.$this->DS.'seeds');

        $name = '';

        $this->filesystem->put(
            fixPath($path.'DatabaseSeeder.php')
            , $this->buildFile($this->getEditStub() , $name)
        );

        $this->filesystem->put(
            fixPath(base_path('resources/views/layouts/app.blade.php'))
            , $this->buildFile($this->getAppStub() , $name)
        );


        $this->filesystem->put(
            fixPath(base_path('config/laraflat.php'))
            , $this->buildFile($this->getConfigStub() , $name)
        );

    }


    /*
     * get file
     */

    protected function getEditStub(){
        return __DIR__.'/../../stubs/install/database-seeder.stub';
    }

    /*
    * get config file
    */

    protected function getConfigStub(){
        return __DIR__.'/../../stubs/config/laraflat.stub';
    }

    /*
   * get file
   */

    protected function getAppStub(){
        return __DIR__.'/../../stubs/install/app.stub';
    }

    /*
     * replace  stub file with data
     */

    protected function buildFile($stub , $name){

        $stub = $this->filesystem->get($stub);

        return $this->replaceName($stub, $name);

    }

    /**
     * Replace table name
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */

    protected function replaceName($stub, $name)
    {
        return str_replace('DummyName', $name, $stub);
    }

}
