<?php

function json(array $response, $code = 200)
{
    http_response_code($code);
    return json_encode($response);
}
