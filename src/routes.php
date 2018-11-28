<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Task;
use App\Models\Recipients;
use App\Models\SpecialOffers;
use App\Models\VoucherCodes;

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {
    $this->logger->info("Home '/' welcome route");
    $data = array(
        'Welcome' => 'Welcome to Vouchers Api REST based API',
        'Version' => 1.0,
        'get' => array(
            'all1' => "http://voucher.api.test/all/john@john.de",
            'all2' => "http://voucher.api.test/all/mary@mar.de",
            'all3' => "http://voucher.api.test/all/jane@jane.de",
            'all4' => "http://voucher.api.test/all/viktoria@viktoria.de",
            'redeem' => "http://voucher.api.test/all/viktoria@viktoria.de",
            'todos' => "http://voucher.api.test/todos",
            'todo1' => "http://voucher.api.test/todo/1",
            'redeem' => "http://voucher.api.test/api/v100/redeem/:",
            'generate' => "http://voucher.api.test/api/v100/generate"
        )
    );
    return $response->withJson($data);
});



// API group
$app->group('/api', function ($app) {
    $app->group('/v100', function ($app) {
        $app->get('/redeem/:voucher_id', function (Request $request, Response $response, array $args) {
            // Sample log message
            $this->logger->info("Slim-Skeleton '/' route");

            $data = array('name' => 'Bob', 'age' => 40);
            return $response->withJson($data);
            // Render index view
            //return $this->renderer->render($response, 'index.phtml', $args);
        });

        $app->get('/generate/:special_offer/:expiration_date', function (Request $request, Response $response, array $args) {
            // Sample log message
            $this->logger->info("Slim-Skeleton '/' route");

            $data = array(
                'voucher_code' => 'Bob',
                'voucher_name' => 40);
            return $response->withJson($data);
            // Render index view
            //return $this->renderer->render($response, 'index.phtml', $args);
        });
    });
});


// Retrieve todo with id
$app->get('/all/{email}', function ($request, $response, $args) {
    $controller = new \App\Controllers\Vouchers(new VoucherCodes());
    return $controller->showVouchers($request, $response, $args);
});

// Retrieve todo with id
$app->get('/redeem/{voucher_code}/{email}', function ($request, $response, $args) {
    $controller = new \App\Controllers\Vouchers(new VoucherCodes());
    return $controller->showVouchers($request, $response, $args);
});

// get all todos
$app->get('/todos', function ($request, $response, $args) {
    $todos = Task::all();
    return $this->response->withJson($todos);
});


// Retrieve todo with id
$app->get('/todo/{id}', function ($request, $response, $args) {
    $controller = new \App\Controllers\Todo(new Task());
    return $controller->getById($request, $response, $args);
});


// Search for todo with given search term in their name
$app->get('/todos/search/[{query}]', function ($request, $response, $args) {
    $todos = Task::where('task', 'like', "%".$args['query']."%");
    return $this->response->withJson($todos);
});

// Add a new todo
$app->post('/todo', function ($request, $response) {
    $input = $request->getParsedBody();
    $task = Task::create(['task' => $input['task']]);
    return $this->response->withJson($task);
});

// DELETE a todo with given id
$app->delete('/todo/[{id}]', function ($request, $response, $args) {
    $task = Task::destroy($args['id']);
    return $this->response->withJson($task);
});


// Update todo with given id
$app->put('/todo/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();

    $task = Task::find($args['id']);
    $task->task = $input['task'];
    $task->save();

    return $this->response->withJson($task);
});