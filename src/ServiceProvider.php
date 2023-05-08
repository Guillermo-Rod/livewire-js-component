<?php 

namespace GuillermoRod\LivewireJsComponents;

use GuillermoRod\LivewireJsComponents\BladeDirectives;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Component;

class ServiceProvider extends LaravelServiceProvider
{
    public const PACKAGE_NAME = 'livewire-js-components';
    public const AUTHOR       = 'Guillermo Rodriguez';
    public const VERSION      = '1.x';

    /**
     * Setting all component prefixes as null
     * 
     * @var string
     */
    public const NULL_PREFIX = '_null-prefix_';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
        $this->registerBladeDirectives();
        $this->registerBladeComponents();
        $this->registerPublishables();
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', self::PACKAGE_NAME);
    }

    protected function registerBladeDirectives()
    {
        Blade::directive('JsComponentStyles', [BladeDirectives::class, 'renderStyles']);
        Blade::directive('JsComponentScripts', [BladeDirectives::class, 'renderScripts']);
    }

    protected function registerBladeComponents()
    {                
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            $prefix = config('livewire-js-components.prefix', 'jscomp');            

            if ($prefix == self::NULL_PREFIX) {
                $prefix = '';
            }

            /** @var BladeComponent $component */
            foreach (config('livewire-js-components.components', []) as $alias => $component) {
                $blade->component($component, $alias, $prefix);
            }
        });
    }

    protected function registerPublishables()
    {
        //php artisan vendor:publish --tag=livewire-js-components-config

        $this->publishes([
            __DIR__ . '/../config/livewire-js-components.php' => $this->app->configPath('livewire-js-components.php')
        ],['livewire-js-components-config','livewire-js-components-config']);

    }

}
