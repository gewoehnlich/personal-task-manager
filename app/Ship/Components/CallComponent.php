<?php

namespace App\Ship\Components;

use App\Ship\Exceptions\ClassDoesNotExistException;
use App\Ship\Exceptions\InvalidArgumentException;
use Exception;

abstract class CallComponent
{
    public function call(...$parameters)
    {
        [$instance, $args] = $this->getInstance(...$parameters);

        if (! $this->parentInstance($instance)) {
            throw new Exception("Class {$parameters[0]} not implement Action");
        }

        return $instance->run(...$args);
    }

    protected function getInstance(...$parameters)
    {
        $this->validateParameters($parameters);

        $class = $parameters[0];
        $args  = array_slice($parameters, 1);

        return [resolve($class), $args];
    }

    protected function validateParameters($parameters)
    {
        if (empty($parameters) || ! is_string($parameters[0])) {
            throw new InvalidArgumentException();
        }

        if (! class_exists($parameters[0]) && ! app()->bound($parameters[0])) {
            throw new ClassDoesNotExistException();
        }
    }

    protected function extractArguments($parameters)
    {
        if (! is_array($parameters)) {
            return [$parameters];
        }

        return $parameters;
    }

    abstract protected function parentInstance($instance): bool;
}
