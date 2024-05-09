<?php

use App\Model\Connection;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\Controller\LoanResourceController;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);

Connection::init();

$app->get('/loans/{id}', function (Request $request, Response $response, $args) {
    $date = LoanResourceController::show($args['id']);

    if (!$date) {
        $response->getBody()->write(json_encode([
            'message' => 'Данные не найдены'
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    } else {
        $response->getBody()->write(json_encode($date));
        return $response->withHeader('Content-Type', 'application/json');
    }
});

$app->get('/loans', function (Request $request, Response $response) {
    $date = LoanResourceController::showList();

    if (!$date) {
        $response->getBody()->write(json_encode([
            'message' => 'Данные не найдены'
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    } else {
        $response->getBody()->write(json_encode($date));
        return $response->withHeader('Content-Type', 'application/json');
    }
});

$app->post('/loans', function (Request $request, Response $response) {
    if (is_null($request->getParsedBody())) {
        $response->getBody()->write(json_encode([
            'message' => 'Ошибка получения данных'
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    $date = LoanResourceController::store($request->getParsedBody());
    $response->getBody()->write(json_encode($date));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->put('/loans/{id}', function (Request $request, Response $response, $args) {
    if (is_null($request->getParsedBody())) {
        $response->getBody()->write(json_encode([
            'message' => 'Ошибка получения данных'
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    $date = LoanResourceController::show($args['id']);

    if (!$date) {
        $response->getBody()->write(json_encode([
            'message' => 'Данные не найдены'
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    } else {
        $date = LoanResourceController::update($request->getParsedBody(), $args['id']);
        $response->getBody()->write(json_encode($date));
        return $response->withHeader('Content-Type', 'application/json');
    }
});

$app->delete('/loans/{id}', function (Request $request, Response $response, $args) {
    $date = LoanResourceController::show($args['id']);

    if (!$date) {
        $response->getBody()->write(json_encode([
            'message' => 'Данные не найдены'
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    } else {
        $date = LoanResourceController::delete($args['id']);
        $response->getBody()->write(json_encode($date));
        return $response->withHeader('Content-Type', 'application/json');
    }
});

$app->run();