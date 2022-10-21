<?php

namespace Mintellity\ResidencyValidator;

use Illuminate\Support\Facades\Http;

class ResidencyValidator
{
    /**
     * @return array|mixed
     */
    public static function get(array $queryArray): mixed
    {
        $queryArray['format'] = 'json';
        $queryArray['addressdetails'] = 1;

        $query = [];
        foreach ($queryArray as $k => $v) {
            $query[] = $k . '=' . $v;
        }

        $response = Http::withHeaders(config('residency-validator.header'))->get(
            config('residency-validator.url'),
            $queryArray
        );

        if ($response->ok()) {
            return $response->json();
        }

        return null;
    }

    /**
     * @param array $query
     * @return bool
     */
    public static function checkAddress(array $query): bool
    {
        $response = self::get($query);

        if (isset($response[0]['address'])) {
            return true;
        }

        return false;
    }
}
