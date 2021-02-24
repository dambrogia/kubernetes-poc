<?php

namespace App\Amqp;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class ConnectionFactory
{
    /**
     * https://www.rabbitmq.com/tutorials/tutorial-one-php.html
     * @return AMQPStreamConnection
     */
    public static function getConnection(): AMQPStreamConnection
    {
        // These are hardcoded into the docker-compose.yml for the amqp_rmq
        // services env vars
        return new AMQPStreamConnection(
            getenv('AMQP_HOST'),
            getenv('AMQP_PORT'),
            getenv('AMQP_USER'),
            getenv('AMQP_PASSWORD')
        );
    }
}
