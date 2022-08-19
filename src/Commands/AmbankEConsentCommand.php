<?php

namespace ProOfficeSolutions\AmbankEConsent\Commands;

use Illuminate\Console\Command;

class AmbankEConsentCommand extends Command
{
    public $signature = 'ambank-e-consent';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
