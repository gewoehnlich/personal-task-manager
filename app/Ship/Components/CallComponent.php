<?php

namespace App\Ship\Components;

use App\Ship\Abstracts\Transporters\Transporter;
use App\Ship\Exceptions\ClassDoesNotExistException;
use App\Ship\Exceptions\ClassIsNotAnInstanceOfComponentClassException;

abstract readonly class CallComponent
{
    abstract protected static function isInstanceOfComponentClass(object $instance): bool;

    abstract protected static function componentClassName(): string;

    public static function call(
        string $className,
        Transporter $transporter,
    ): mixed {
        if (! class_exists($className) && ! app()->bound($className)) {
            throw new ClassDoesNotExistException(
                className: $className,
            );
        }

        $instance = resolve($className);

        if (! static::isInstanceOfComponentClass($instance)) {
            throw new ClassIsNotAnInstanceOfComponentClassException(
                className: $className,
                componentClassName: static::componentClassName(),
            );
        }

        return $instance->run(
            transporter: $transporter,
        );
    }
}
