<?php

namespace Spatie\Feed;

use Illuminate\Support\Facades\View;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\Feed\Helpers\Path;
use Spatie\Feed\Http\FeedController;

class FeedServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-feed')
            ->hasConfigFile()
            ->hasViews();
    }

    public function packageBooted()
    {
        $this->registerLinksComposer();
    }

    public function packageRegistered()
    {
        $this->registerRouteMacro();
    }

    protected function registerRouteMacro(): void
    {
        $router = $this->app['router'];

        $router->macro('feeds', function ($baseUrl = '') use ($router) {
            foreach (config('feed.feeds') as $name => $configuration) {
                $url = Path::merge($baseUrl, $configuration['url']);

                $router->get($url, '\\'.FeedController::class)->name("feeds.{$name}");
            }
        });
    }

    public function registerLinksComposer(): void
    {
        View::composer('feed::links', function ($view) {
            $view->with('feeds', $this->feeds());
        });
    }

    protected function feeds()
    {
        return collect(config('feed.feeds'));
    }
}
