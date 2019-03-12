<?php

namespace console\components;


use common\models\tables\Chat;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\WebSocket\WsConnection;
use yii\base\Component;

class WebSocketServer extends Component implements MessageComponentInterface
{
    /**
     * @var WsConnection[]
     */
    private $clients = [];

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        parent::__construct();
        echo "Server started...\n";
    }

    /**
     * @param WsConnection $conn
     */
    function onOpen(ConnectionInterface $conn)
    {
        $query = $conn->httpRequest->getUri()->getQuery();
        $channel = explode('=', $query)[1];

        $this->clients[$channel][$conn->resourceId] = $conn;
        echo "New connection: {$conn->resourceId}\n";
    }

    /**
     * @param WsConnection $conn
     */
    function onClose(ConnectionInterface $conn)
    {
        unset($this->clients[$conn->resourceId]);
    }

    /**
     * @param WsConnection $conn
     * @param \Exception $e
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo $e->getMessage() . PHP_EOL;
        $conn->close();
        unset($this->clients[$conn->resourceId]);
    }

    /**
     * @param WsConnection $from
     * @param string $chatData
     */
    function onMessage(ConnectionInterface $from, $chatData)
    {
        $chatData = json_decode($chatData, true);
        (new Chat($chatData))->save();

        echo "{$from->resourceId}: {$chatData['message']}\n";

        $channel = $chatData['channel'];

        foreach ($this->clients[$channel] as $client) {
            $client->send($chatData['message']);
        }
    }
}