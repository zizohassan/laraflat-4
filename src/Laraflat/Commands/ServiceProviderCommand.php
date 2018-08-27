<?php

namespace Laraflat\Laraflat\Laraflat\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

use Laraflat\Laraflat\Laraflat\Models\Module;

class ServiceProviderCommand extends Command
{

    protected $DS = DIRECTORY_SEPARATOR;

    protected $filesystem;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laraflat:provider {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'We now generate services provider file based on module name';

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
        $moduleName = $this->argument('module');

        $module = Module::where('name' , $moduleName)->first();

        $this->filesystem->put(
            fixPath(base_path('app/Modules/'.$module->name.'/Providers/Laraflat'.$module->name.'ServicesProvider.php'))
            , $this->buildFile($module->name , mb_strtolower($module->name))
        );

    }

    /*
     * get file
     */

    protected function getStub(){
        return __DIR__.'/../../stubs/services_provider.stub';
    }

    /*
     * replace  stub file with data
     */

    protected function buildFile($className , $name){

        $stub = $this->filesystem->get($this->getStub());

        return $this->replaceContent($stub, $className)->replaceName($stub, $name);

    }

    /**
     * Replace content of migration
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */

    protected function replaceContent(&$stub, $content)
    {
        $stub = str_replace(
            ['DummyClassName' , 'DummyConfigName'],
            [$content , str_singular($content)],
            $stub
        );
        return $this;
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
