<?php

namespace V2ray;

class Utils implements Contract
{
    public static function genBaseConnInfo($method, $uuid, $server, $port)
    {
        return base64_encode(sprintf("%s:%s@%s:%s", $method, $uuid, $server, $port));
    }

    public static function genConnString($method, $uuid, $server, $port, $obfs = "", $tls = 0, $path = "", $remark = "")
    {
        $base = self::genBaseConnInfo($method, $uuid, $server, $port);
        return sprintf("vmess://%s?remarks=%s&path=%s&obfs=%s&tls=%s", $base,
            $remark, $path, $obfs, $tls);
    }
}