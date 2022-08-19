<?php

namespace ProOfficeSolutions\AmbankEConsent;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AmbankEConsent
{
    public function authenticate()
    {
        $url = config('ambank-e-consent.url') . '/api/oauth/v2.0/token';

        $response = Http::asForm()
            ->withBasicAuth(config('ambank-e-consent.client_id'), config('ambank-e-consent.client_secret'))
            ->withHeaders([
                'ClientID' => config('ambank-e-consent.client_id'),
            ])->post($url, [
                'grant_type' => 'client_credentials',
                'scope' => 'resource.READ,resource.WRITE',
            ]);

        if (isset($response->object()->ResponseCode)) {
            throw new \Exception($response->object()->ResponseMessage, 400);
        }

        return $response->object()->access_token;
    }

    public function requestConsent()
    {
        $srcRefNo = $this->getSrcRefNo();

        $token = Cache::remember('duitnow_qr_token', config('ambank-e-consent.token_expiry'), fn () => $this->authenticate());

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Authentication' => $token,
            'AmBank-Timestamp' => now()->format('dmYHis'),
            'Channel-Token' => config('ambank-e-consent.channel_token'),
            'srcRefNo' => $srcRefNo,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'ColourType' => config('ambank-e-consent.colour_type'),
            'QRWidth' => 512,
            'QRHeight' => 512,
        ];

        $url = config('ambank-e-consent.url') . "/EConsent/v1.0/RTD/$srcRefNo";
        // Http::post()
    }

    protected function getSrcRefNo()
    {
        $sequence = str_pad(Cache::increment('duitnow_e_consent'), 6, "0", STR_PAD_LEFT);

        return config('ambank-e-consent.prefix_id') . date('dmY') . $sequence;
    }
}
