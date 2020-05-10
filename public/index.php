<?php

require '../vendor/autoload.php';

use function Http\Response\send;

$app = new \Framework\App(

);

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

send($response);
