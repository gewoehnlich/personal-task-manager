<?php

namespace App\Ship\Abstracts\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

abstract class Repository extends BaseRepository
{
    public function get(
        $columns = ['*'],
    ) {
        $return = parent::get($columns);

        $this->resetCriteria();

        return $return;
    }
}
