<?php

namespace App\Macros;

class GetMethod
{
    public function getMethod()
    {
        return function ($prefix = "123", $extraString = "456") {

            return "$prefix - " . $this->method . " - $extraString";
        };
    }


    // example for single macro classes
//    public function __invoke($extraString = "works")
//    {
//
////       return "$this->method - $extraString";  => will not work cuz "$this" refers to the current object of class
//
//       return $extraString;
//    }
}