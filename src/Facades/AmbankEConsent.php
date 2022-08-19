<?php

namespace ProOfficeSolutions\AmbankEConsent\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ProOfficeSolutions\AmbankEConsent\AmbankEConsent
 */
class AmbankEConsent extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ProOfficeSolutions\AmbankEConsent\AmbankEConsent::class;
    }
}
