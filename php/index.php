<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Amqp\Queue as Amqp;
use App\MySQL\Client as MySQL;
use App\Redis\Client as Redis;

try {
    $messages = Amqp::test();
    $databases = MySQL::test();
    $pong = Redis::test();
} catch (\Throwable $e) {
    echo "<p>" . $e->getMessage() . "<p>";
    exit(1);
}

$unique = uniqid('unique-id-');
?>

<h3>Varnish</h3>
<p>
    Varnish will cache the contents of this page if it is working correctly.
    This means that if you refresh this page, the timestamps on the messages
    should be exactly the same. If you add a GET param to the URL you should
    be able to bust the cache and see updated timestamps for that unique URL.

    <br />
    <a href="/?unique-id=<?= $unique ?>">Bust Cache</a>
</p>

<hr>

<h3>RMQ Messages</h3>
<ul>
<?php foreach ($messages as $m): ?>
    <li><span><?= $m ?></span></li>
<?php endforeach ?>
</ul>

<hr>

<h3>MySQL Databases</h3>
<ul>
<?php foreach ($databases as $db): ?>
    <li><span><?= $db['Database'] ?></span></li>
<?php endforeach ?>
</ul>

<hr>

<h3>Redis Connection</h3>
<p>PING: <?= $pong ?></p>
