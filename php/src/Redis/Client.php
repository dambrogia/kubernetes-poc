<?php

namespace App\Redis;

use Predis\Client as Redis;

class Client {

    /**
     * Return the response from the redis ping command.
     *
     * @return string
     */
    public static function test(): string
    {
        $host = getenv('REDIS_HOST');
        $port = getenv('REDIS_PORT');
        $client = new Redis([
            'scheme' => 'tcp',
            'host'   => $host,
            'port'   => $port,
        ]);

        return $client->ping();
    }
}
