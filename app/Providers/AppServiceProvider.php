<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //header
        Blade::component('components.header.header', 'header');
        Blade::component('components.header.header-top', 'header-top');
        Blade::component('components.header.header-main', 'header-main');

        //footer
        Blade::component('components.footer.footer', 'footer');
        Blade::component('components.footer.footer-content', 'footer-content');
        Blade::component('components.footer.footer-bottom', 'footer-bottom');

        //breadcrumbs
        Blade::component('components.breadcrumbs.breadcrumbs', 'breadcrumbs');

        //About
        Blade::component('about.story-block', 'story-block');
        Blade::component('about.statistics', 'statistics');
        Blade::component('about.team', 'team');
        Blade::component('about.features', 'features');



        //layouts
        Blade::component('components.layouts.layout', 'layout');
    }
}
