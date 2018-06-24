<?php

namespace V2ray;

class Utils implements Contract
{
    /**
     * @param $method
     * @param $uuid
     * @param $server
     * @param $port
     * @return string
     */
    public static function genBaseConnInfo($method, $uuid, $server, $port)
    {
        return base64_encode(sprintf("%s:%s@%s:%s", $method, $uuid, $server, $port));
    }

    /**
     * @param $method
     * @param $uuid
     * @param $server
     * @param $port
     * @param string $obfs
     * @param int $tls
     * @param string $path
     * @param string $remark
     * @return string
     */
    public static function genShadowrocketConnString($method, $uuid, $server, $port, $alterID, $obfs = "", $tls = 0, $path = "", $remark = "")
    {
        $base = self::genBaseConnInfo($method, $uuid, $server, $port);
        return sprintf("vmess://%s?remarks=%s&path=%s&obfs=%s&tls=%s", $base,
            $remark, $path, $obfs, $tls);
    }


    /**
     * @param $method
     * @param $uuid
     * @param $server
     * @param $port
     * @param $alterID
     * @param $level
     * @param string $obfs
     * @param int $tls
     * @param string $path
     * @param string $remark
     * @return string
     */
    public static function genBfvConnString($method, $uuid, $server, $port, $alterID, $level, $obfs = "", $tls = 0, $path = "", $remark = "")
    {
        if ($tls) {
            $tls = 'tls';
        } else {
            $tls = '';
        }

        if ($obfs == "websocket") {
            $obfs = "ws";
        }

        $ws = urlencode(sprintf("path=%s", $path));

        return sprintf("bfv://%s:%s/vmess/1?rtype=all&dns=8.8.8.8&tnet=%s&tsec=%s&uid=%s&aid=%s&lev=%s&sec=auto&ws=%s#%s", $server, $port,
            $obfs, $tls, $uuid, $alterID, $level, $ws, $remark);
    }

    /**
     * @param $method
     * @param $uuid
     * @param $server
     * @param $port
     * @param $alterID
     * @param $level
     * @param string $obfs
     * @param int $tls
     * @param string $path
     * @param string $remark
     * @return array
     */
    public static function getNJsonMap($method, $uuid, $server, $port, $alterID, $level, $obfs = "", $tls = 0, $path = "", $remark = "")
    {
        $tlsStr = "";
        if ($tls) {
            $tlsStr = "tls";
        }
        $type = "none";
        if ($method != "") {
            $type = $method;
        }
        $net = self::tcp;
        if ($obfs != "") {
            $net = $obfs;
        }
        return [
            "v" => "2",
            "ps" => $remark,
            "add" => $server,
            "port" => $port,
            "id" => $uuid,
            "aid" => $alterID,
            "net" => $net,
            "type" => $type,
            "host" => $server,
            "path" => $path,
            "tls" => $tlsStr,
        ];
    }
}