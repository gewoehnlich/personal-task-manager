<?php

namespace App\Ship\Parents\Actions;

use App\Ship\Abstracts\Actions\Action as AbstractAction;
use App\Ship\Parents\Transporters\Transporter;

abstract class Action extends AbstractAction
{
    public function run(
        Transporter $transporter,
    ): Responder {
        //
    }
}
