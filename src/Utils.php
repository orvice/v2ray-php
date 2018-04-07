<?php

namespace V2ray;

class Utils implements Contract
{
    public static function genBaseConnInfo($method, $uuid, $server, $port)
    {
        return base64_encode(sprintf("%s:%s@%s:%s", $method, $uuid, $server, $port));
    }

    public static function genConnString($method, $uuid, $server, $port)
    {
        $base = self::genBaseConnInfo($method, $uuid, $server, $port);

    }
}