<?php

namespace NotificationChannels\ExpoPushNotifications\Repositories;

use ExponentPhpSDK\ExpoRepository;
use NotificationChannels\ExpoPushNotifications\Models\Interest;

class ExpoDatabaseDriver implements ExpoRepository
{
    /**
     * Stores an Expo token with a given identifier
     *
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public function store($key, $value): bool
    {
        $interest = Interest::firstOrCreate([
            'key' => $key,
            'value' => $value
        ]);

        return $interest instanceof Interest;
    }

    /**
     * Retrieves an Expo token with a given identifier
     *
     * @param string $key
     *
     * @return string|null
     */
    public function retrieve(string $key)
    {
        $interest = Interest::where('key', $key)->first();

        if($interest instanceof Interest)
        {
            return (string) $interest->value;
        }

        return null;
    }

    /**
     * Removes an Expo token with a given identifier
     *
     * @param string $key
     *
     * @return bool
     */
    public function forget(string $key): bool
    {
        return Interest::where('key', $key)->delete();
    }
}