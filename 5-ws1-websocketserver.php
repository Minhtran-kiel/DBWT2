<?php

require __DIR__ .'/vendor/autoload.php';

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\App;

class MyExample implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        echo "Adding new connection\n";
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        
    }

    public function onClose(ConnectionInterface $conn)
    {
        echo "Closing connection\n";
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, Exception $e)
    {
        echo "Closing connection with error\n";
        $conn->close();
    }
}

$app = new App('localhost', 8085);
$app->route('/5-ws1-connect', new MyExample, array('*'));

echo "starting WebsocketServer\n";
$app->run();