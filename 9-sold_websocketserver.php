<?php
require __DIR__ . '/vendor/autoload.php';

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\App;


class Sold implements MessageComponentInterface {
    protected $clients;

    public function __construct(){
        $this->clients = new \SplObjectStorage;
    }
    
    public function onOpen (ConnectionInterface $conn){
        // get the userId from connection url
        $queryParams = $conn->httpRequest->getUri()->getQuery();
        parse_str($queryParams, $params);
        $sessionUserId = $params['userId'];
        
        // Create a custom data object store the connection and the userId
        $client = new \stdClass();
        $client->connection = $conn;
        $client->sessionUserId = $sessionUserId; 
        
        echo "Adding new connection to user $sessionUserId\n";
        $this->clients->attach($client);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Received: $msg\n";
        $data = json_decode($msg, true);

        if(isset($data['userId']) && isset($data['articleId']) && isset($data['message'])){
            $userId = (string) $data['userId'];
            $message = $data['message'];

            foreach($this->clients as $client){
                //check if the client is online and has the same userId
                if($client->connection !== $from && $client->sessionUserId == $userId){
                    echo "Sending: message to user $client->sessionUserId \n";
                    $client->connection->send($message);
                }
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        echo "Closing connection\n";
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, Exception $e){
        echo "Closing connection with error\n";
        $conn->close();
    }
}

$app = new App('localhost', 8085);
$app->route('/sell', new Sold, array('*'));

echo "starting WebsocketServer\n";
$app->run();