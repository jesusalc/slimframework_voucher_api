<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;

class Todo {

    /**
     * @var \App\Models\Task
     */
    private $task;

    public function __construct(\App\Models\Task $task)
    {

        $this->task = $task;
    }

    public function getById(ServerRequestInterface $request, Response $response, $args)
    {
        $task = $this->task->manualFind($args['id']);

        return $response->withJson($task);
    }
}