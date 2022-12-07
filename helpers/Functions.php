<?php
namespace helpers;

class Functions
{
    public static function createGuid()
    {
        $microTime = microtime();
        list($aDec, $aSec) = explode(" ", $microTime);

        $decHex = sprintf("%x", $aDec * 1000000);
        $secHex = sprintf("%x", $aSec);

        self::ensureLength($decHex, 5);
        self::ensureLength($secHex, 6);

        $guid = "";
        $guid .= $decHex;
        $guid .= self::createGuidSection(3);
        $guid .= '-';
        $guid .= self::createGuidSection(4);
        $guid .= '-';
        $guid .= self::createGuidSection(4);
        $guid .= '-';
        $guid .= self::createGuidSection(4);
        $guid .= '-';
        $guid .= $secHex;
        $guid .= self::createGuidSection(6);

        return $guid;
    }

    private static function createGuidSection($characters)
    {
        $return = "";
        for ($i = 0; $i < $characters; $i++) {
            $return .= sprintf("%x", mt_rand(0, 15));
        }
        return $return;
    }

    private static function ensureLength(&$string, $length)
    {
        $strlen = strlen($string);
        if ($strlen < $length) {
            $string = str_pad($string, $length, "0");
        } else if ($strlen > $length) {
            $string = substr($string, 0, $length);
        }
    }
    
    public static function get_response_time()
    {
        $diff = microtime(true) - IO_BEGIN_TIME;
        $response_time_string = "Response Time: {$diff} seconds";
        return $response_time_string;
    }
}