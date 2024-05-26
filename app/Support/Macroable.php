<?php

namespace App\Support;

use ReflectionClass;
use ReflectionException;

trait Macroable
{
    public static $macros = [];

    public static function macro($name, $macro)
    {
        self::$macros[$name] = $macro;
    }

    public static function hasMacro($name)
    {
        return isset(self::$macros[$name]);
    }

    /**
     * @throws ReflectionException
     */
    public static function mixin($mixin)
    {
        $methods = (new ReflectionClass($mixin))->getMethods(
            \ReflectionMethod::IS_PUBLIC | \ReflectionMethod::IS_PROTECTED
        );

        foreach ($methods as $method){
            $method->setAccessible(true);

            self::macro($method->name, $method->invoke($mixin));
        }
    }

    public function __call($method, $arguments)
    {
        if (! self::hasMacro($method)){
            throw new \BadMethodCallException("Method {$method} does not exist.");
        }

        $macro = self::$macros[$method];

        if ($macro instanceof \Closure) {
            return call_user_func_array($macro->bindTo($this, self::class), $arguments);
        }

        return call_user_func_array($macro, $arguments);
    }

    public static function __callStatic($method, $arguments)
    {
        if (! self::hasMacro($method)){
            throw new \BadMethodCallException("Method {$method} does not exist.");
        }

        $macro = self::$macros[$method];

        if ($macro instanceof \Closure) {
            return call_user_func_array(\Closure::bind($macro, null,static::class), $arguments);
        }

        return call_user_func_array($macro, $arguments);
    }
}