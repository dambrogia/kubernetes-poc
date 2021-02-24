<?php

namespace App\MySQL;

class Client {

    /**
     * Return an array of the available databases. This proves our connectivity
     * to the mysql/database service.
     *
     * @return array
     */
    public static function test(): array
    {

        $host = getenv('MYSQL_HOST');
        $user = getenv('MYSQL_USER');
        $pass = getenv('MYSQL_PASSWORD');

        $conn = new \mysqli($host, $user, $pass);

        if ($conn->connect_errno) {
            throw new \Exception('MySQL error: '. $conn->connect_error);
        }

        $sql = 'show databases';
        return $conn->query($sql)->fetch_assoc();
    }
}
