<?php
require __DIR__ . '/vendor/autoload.php';

\Ratchet\Client\connect('ws://localhost:8085/chat')
    ->then(function ($conn){
        $conn->on('messgae', function($msg) use ($conn) {
            echo "Received: {$msg}\n";
            $conn->close();
        });
        $conn->send('Hello to everyone!');
    }, 
    function($e){
        echo "Cound not connect: {$e->getMessage()}\n";
    });

