<?php

namespace ProOfficeSolutions\AmbankEConsent;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AmbankEConsentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('ambank-e-consent')
            ->hasConfigFile('ambank-e-consent')
            ->hasMigration('create_e_consent_transactions_table');
    }
}
