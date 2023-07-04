<?php
namespace app\helpme;

class MyNumber {
    public static function strip($val) {
        return str_replace(",", "", $val);
    }
}