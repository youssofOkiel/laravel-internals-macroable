<?php

use App\Http\Request;
use App\Macros\GetMethod;

require  'vendor/autoload.php';

//Request::macro('getMethod', function () {
//   return $this->method;
//});
//
//Request::macro('getMethod2', function ($extraString = "123") {
//   return $this->method . $extraString;
//});

Request::mixin(new GetMethod());

//Request::macro('getMethod', new GetMethod());
$request = new Request();
//dump($request->getMethod(), $request->getMethod2("456"));

dd($request->getMethod());