<?php

namespace App\Amqp;

use PhpAmqpLib\Message\AMQPMessage;

/**
 * Ideally this would be split into multiple classes. However for the sake of
 * testing and simplicitly it is in one class.
 */
class Queue
{
    const NAME = 'TEST_QUEUE';

    /**
     * Produce a message to the queue.
     *
     * @param string $string
     * @return void
     */
    private static function produce(string $string): void
    {
        $connection = ConnectionFactory::getConnection();
        $channel = $connection->channel();
        $channel->queue_declare(static::NAME);
        $message = new AMQPMessage($string);
        $channel->basic_publish($message, '', static::NAME);
        $channel->close();
        $connection->close();
    }

    /**
     * Consume the messages on the queue currently.
     *
     * @return void
     */
    private static function consume(): array
    {
        $responses = [];

        $callback = function ($message) use ($responses) {
            $responses[] = $message->body;
        };

        $connection = ConnectionFactory::getConnection();
        $channel = $connection->channel();
        $channel->queue_declare(static::NAME);
        $channel->basic_consume(static::NAME, '', false, true, false, false, $callback);

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();

        return $responses;
    }

    /**
     * Static method to test producing and consuming from queue.
     *
     * @return array
     */
    public static function test(): array
    {
        $time = time();
        static::produce('message 1 - ' . $time);
        static::produce('message 2 - ' . $time);
        static::produce('message 3 - ' . $time);
        return static::consume();
    }
}
