<?php

namespace bland-industries\BigtimeApi;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use bland-industries\BigtimeApi\Commands\BigtimeApiCommand;

class BigtimeApiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('bigtime-api')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_bigtime-api_table')
            ->hasCommand(BigtimeApiCommand::class);
    }
}
