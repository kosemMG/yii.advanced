<?php

namespace console\controllers;


use console\components\WebSocketServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use yii\console\Controller;

/**
 * Class ServerController manages servers.
 * @package console\controllers
 */
class ServerController extends Controller
{
    /**
     * Starts WebSocket server.
     */
    public function actionWs()
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSocketServer()
                )
            ),
            8080
        );

        $server->run();
    }
}