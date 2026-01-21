<?php

namespace App\Ship\Components;

use App\Ship\Abstracts\Dto\Dto;
use App\Ship\Exceptions\ClassDoesNotExistException;
use App\Ship\Exceptions\ClassIsNotAnInstanceOfComponentClassException;

abstract readonly class CallComponent
{
    public static function call(
        string $class,
        Dto $dto,
    ): mixed {
        if (! class_exists($class) && ! app()->bound($class)) {
            throw new ClassDoesNotExistException(
                class: $class,
            );
        }

        $instance = resolve($class);

        if (! static::isInstanceOfComponentClass($instance)) {
            throw new ClassIsNotAnInstanceOfComponentClassException(
                class: $class,
                componentClass: static::componentClass(),
            );
        }

        return $instance->run(
            dto: $dto,
        );
    }

    abstract protected static function isInstanceOfComponentClass(object $instance): bool;

    abstract protected static function componentClass(): string;
}
