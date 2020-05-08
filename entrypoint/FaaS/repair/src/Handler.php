<?php

namespace SofiB\Delivery\FaaS;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response;

use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;

use SofiB\Business\VehicleRoot;
use SofiB\Infrastructure\VoidEventStream;

/**
 * Class Handler
 * @package SofiB\Delivery\FaaS
 */
class Handler implements RequestHandlerInterface
{
    private $emitter;
    public function __construct (EmitterInterface $emitter) {
        $this->emitter = $emitter;
    }

    public function handle (ServerRequestInterface $request) : ResponseInterface {
        parse_str($request->getUri()->getQuery(), $qs);
        $vehicle = VehicleRoot::createVehicleFromType($qs['type']);
        if ($vehicle === null) {
            return (new Response())
                ->withStatus(400);
        }

        $process = VehicleRoot::serveVehicle($vehicle, new VoidEventStream());
        $cost = $process->service()->repair();

        $response = (new Response())
            ->withStatus(200)
            ->withAddedHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode((object)['cost' => $cost]));

        return $response;
    }
}
