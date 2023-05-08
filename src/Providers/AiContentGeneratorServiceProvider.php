<?php
namespace WebbyTroops\AiContentGenerator\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;


/**
* AiContentGeneratorServiceProvider
*
* @copyright 2023 WebbyTroops Technologies Pvt. Ltd. (http://www.webbytroops.com)
*/
class AiContentGeneratorServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap services.
    *
    * @return void
    */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/admin-routes.php');

        
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'ai-content-generator');
        
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php', 'core'
        );
        
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'ai-content-generator');
        
        $this->publishes([
             __DIR__ . '/../Resources/views/admin/catalog/products/field-types/textarea.blade.php' =>
            resource_path('admin-themes/default/views/catalog/products/field-types/textarea.blade.php')
        ]);
        
        $this->publishes([
             __DIR__ . '/../Resources/views/admin/cms/create.blade.php' =>
            resource_path('admin-themes/default/views/cms/create.blade.php')
        ]);
        
        $this->publishes([
             __DIR__ . '/../Resources/views/admin/cms/edit.blade.php' =>
            resource_path('admin-themes/default/views/cms/edit.blade.php')
        ]);
        
    }

}