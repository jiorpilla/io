<?php
namespace modules\Test;
class Test
{

    public function __construct()
    {
        echo 'test_read<br>';
    }

    public static function getTest()
    {
        return 'test moto modules';
    }
}