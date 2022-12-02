<?php

namespace Laraflat\Laraflat\Providers;


use Laraflat\Laraflat\Chumper\Zipper\Zipper;
use Laraflat\Laraflat\Chumper\Zipper\ZipperServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Laraflat\Laraflat\Laraflat\Commands\AdminAddEditCommand;
use Laraflat\Laraflat\Laraflat\Commands\AdminControllerCommand;
use Laraflat\Laraflat\Laraflat\Commands\AdminFormCommand;
use Laraflat\Laraflat\Laraflat\Commands\AdminIndexCommand;
use Laraflat\Laraflat\Laraflat\Commands\AdminRelationCommand;
use Laraflat\Laraflat\Laraflat\Commands\AdminRequestCommand;
use Laraflat\Laraflat\Laraflat\Commands\AdminRouteCommand;
use Laraflat\Laraflat\Laraflat\Commands\ApiControllerCommand;
use Laraflat\Laraflat\Laraflat\Commands\ApiRequestCommand;
use Laraflat\Laraflat\Laraflat\Commands\ApiResourcesCommand;
use Laraflat\Laraflat\Laraflat\Commands\ApiRouteCommand;
use Laraflat\Laraflat\Laraflat\Commands\ConfigCommand;
use Laraflat\Laraflat\Laraflat\Commands\FrontAddEditCommand;
use Laraflat\Laraflat\Laraflat\Commands\FrontControllerCommand;
use Laraflat\Laraflat\Laraflat\Commands\FrontFormCommand;
use Laraflat\Laraflat\Laraflat\Commands\FrontIndexCommand;
use Laraflat\Laraflat\Laraflat\Commands\FrontRequestCommand;
use Laraflat\Laraflat\Laraflat\Commands\FrontRouteCommand;
use Laraflat\Laraflat\Laraflat\Commands\InstallCommand;
use Laraflat\Laraflat\Laraflat\Commands\LangCommand;
use Laraflat\Laraflat\Laraflat\Commands\MigrationCommand;
use Laraflat\Laraflat\Laraflat\Commands\ModelCommand;
use Laraflat\Laraflat\Laraflat\Commands\SeederCommand;
use Laraflat\Laraflat\Laraflat\Commands\ServiceProviderCommand;
use Laraflat\Laraflat\Laraflat\Traits\FileTrait;


class LaraflatServiceProvider extends ServiceProvider
{

    use FileTrait;

    protected $DS = DIRECTORY_SEPARATOR;

    /**
     * Bootstrap services.
     *
     * @return void
     */

    public function boot()
    {

        app()->register(ZipperServiceProvider::class);

        $modulePath = app_path('Modules');

        $this->createFolder($modulePath);

        $location = __DIR__ . $this->DS . '../Resources' . $this->DS . 'Modules' . $this->DS . 'Users.zip';
        
        if ($this->fileExists($location)) {
            $destination = app_path('Modules');

            $zip = new Zipper();

            $zip->zip($location)->extractTo($destination);
        }

        /*
         * change the auth to laraflat auth
         */

        $this->publishes([
            __DIR__ . '/../Resources/config' => base_path('config'),
        ], 'laraflat');


        /*
         * publish Admin panel Style
         * first put all js and css in public folder
         */

        $this->publishes([
            __DIR__ . '/../Resources/assets' => public_path('assets'),
        ], 'laraflat');

        /*
         * copy All users files to modules
         */

        $this->publishes([
            __DIR__ . '/../Resources/Modules' => $modulePath,
        ], 'laraflat');


        /*
         * load laraflat language files
         */

        $this->loadTranslationsFrom(__DIR__ . '/../Laraflat/lang', 'laraflat');

        /*
         * load laraflat migrations files
         */

        $this->loadMigrationsFrom(__DIR__ . '/../Laraflat/migrations');

        /*
         * load laraflat routes
         * generators routes
         */

        $this->loadRoutesFrom(__DIR__ . '/../Laraflat/routes/admin.php');

        /*
         * loads laraflat files
         * generators views
         */

        $this->loadViewsFrom(__DIR__ . '/../Laraflat/views', 'laraflat');

        /*
       * load all Providers
       */

        $this->loadProviders();

        /*
         * register command
         */

        $this->commands([
            MigrationCommand::class,
            ServiceProviderCommand::class,
            AdminRouteCommand::class,
            ModelCommand::class,
            AdminIndexCommand::class,
            AdminAddEditCommand::class,
            AdminControllerCommand::class,
            AdminFormCommand::class,
            AdminRequestCommand::class,
            ConfigCommand::class,
            SeederCommand::class,
            InstallCommand::class,
            LangCommand::class,
            ApiResourcesCommand::class,
            ApiRouteCommand::class,
            ApiControllerCommand::class,
            ApiRequestCommand::class,
            FrontRouteCommand::class,
            FrontIndexCommand::class,
            FrontAddEditCommand::class,
            FrontControllerCommand::class,
            FrontFormCommand::class,
            FrontRequestCommand::class
        ]);

    }

    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {

        /*
         * register helpers files
         */

        $this->registerHelpers('arrays');
        $this->registerHelpers('path');
        $this->registerHelpers('crud');
        $this->registerHelpers('lang');
        $this->registerHelpers('function');

    }

    /**
     * load helpers.
     *
     * @return void
     */

    public function registerHelpers($file)
    {
        // Load the helpers in app/Http/helpers.php
        if (file_exists($file = __DIR__ . '/../Laraflat/Helpers/' . $file . '.php')) {
            require $file;
        }
    }


    /*
     * load All Providers
     * that will generated with laraflat
     */

    public function loadProviders()
    {

        $path = base_path('app' . $this->DS . 'Modules');

        if (is_dir($path)) {

            $directories = File::directories($path);

            if (!empty($directories)) {

                foreach ($directories as $directory) {

                    $moduleName = explode($this->DS, $directory);

                    $moduleName = end($moduleName);

                    $fullProviderPath = $directory . $this->DS . 'Providers' . $this->DS . 'Laraflat' . $moduleName . 'ServicesProvider.php';

                    if (file_exists($fullProviderPath)) {

                        $nameSpace = 'App\\Modules\\' . $moduleName . '\\Providers\\' . 'Laraflat' . $moduleName . 'ServicesProvider';

                        app()->register($nameSpace);

                    }
                }
            }
        }

    }
}
