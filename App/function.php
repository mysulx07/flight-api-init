<?php
function dd($item): void
{
    echo "<pre>";
    var_dump($item);
    echo "</pre>";
    die();
}

function dc($item): void
{
    echo "<pre>";
    var_dump($item);
    echo "</pre>";
}

function ds($item): void
{
    echo "<br>" . $item;
}

function abort(int $code, string $message = ""): void
{
    // http_response_code($code);
    // header('Content-Type: application/json; charset=utf-8');
    // echo json_encode(["code"=> $code,"message"=> $message]);
    // die();
    Flight::jsonHalt(["message" => $message], $code);
}

function respond($data, int $code = 200): void
{
    // http_response_code($code);
    // header('Content-Type: application/json; charset=utf-8');
    // echo json_encode(["code"=> $code,"data"=> $data]);

    // die();

    Flight::jsonHalt($data, $code);
}