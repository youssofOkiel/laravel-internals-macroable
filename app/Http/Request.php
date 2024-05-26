<?php

namespace App\Http;

use App\Support\Macroable;

class Request
{
    use Macroable;

    public $method = "GET";

}