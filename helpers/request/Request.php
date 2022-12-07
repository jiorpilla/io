<?php

namespace helpers\request;

class Request
{
    public function getRequest($request)
    {
        return self::sanitizeRequest($_REQUEST[$request]);
    }

    public function sanitizeRequest($input)
    {
        return $input;
    }
}