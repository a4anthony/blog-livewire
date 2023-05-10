<?php

namespace A4Anthony\BlogLivewire;

use A4Anthony\BlogLivewire\Commands\BlogLivewireCommand;
use A4Anthony\BlogLivewire\Http\Livewire\SinglePost;
use A4Anthony\BlogLivewire\Http\Livewire\Test;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BlogLivewireServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name("blog-livewire")
            ->hasConfigFile()
            ->hasViews("blog-livewire")
            ->hasAssets()
            ->hasMigration("create_blog_categories_table")
            ->hasMigration("create_blog_posts_table")
            ->hasCommand(BlogLivewireCommand::class);
    }

    public function bootingPackage()
    {
        Livewire::component("posts", Test::class);
        Livewire::component("single-post", SinglePost::class);
    }
}
