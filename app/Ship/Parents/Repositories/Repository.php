<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Abstracts\Repositories\Repository as AbstractRepository;

abstract class Repository extends AbstractRepository
{
    abstract public function model(): string;
}
