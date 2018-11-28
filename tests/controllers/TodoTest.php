<?php
/**
 * Created by PhpStorm.
 * User: benutzer
 * Date: 28.11.18
 * Time: 13:20
 */

namespace Tests\controllers;

use App\Controllers\Todo;
use App\Models\Task;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;

class TodoTest extends \PHPUnit_Framework_TestCase
{

    public function testGetById()
    {
        $someInt = 139842;
        $someTask = [
            'id' => $someInt,
            'task' => 'someTask',
            'status' => 0,
            'created_at' => '2018-10-10 00:00:00'
        ];

        /** @var ServerRequestInterface|\PHPUnit_Framework_MockObject_MockObject $requestMock */
        $requestMock = $this->createMock(ServerRequestInterface::class);

        /** @var Response|\PHPUnit_Framework_MockObject_MockObject $responseMock */
        $responseMock = $this->createMock(Response::class);
        $responseMock->expects($this->once())
            ->method('withJson')
            ->with($someTask)
            ->willReturnSelf();

        /** @var Task|\PHPUnit_Framework_MockObject_MockObject $taskModelMock */
        $taskModelMock = $this->createMock(Task::class);
        $taskModelMock->expects($this->once())
            ->method('manualFind')
            ->with($someInt)
            ->willReturn($someTask);

        $classUnderTest = new Todo($taskModelMock);
        $classUnderTest->getById($requestMock, $responseMock, ['id' => $someInt]);

    }
}
