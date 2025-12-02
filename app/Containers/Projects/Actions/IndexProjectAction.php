<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Transporters\IndexProjectTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use Exception;

final readonly class IndexProjectAction extends Action
{
    public function run(
        IndexProjectTransporter $transporter,
    ): Responder {
        try {
            $projects = null;
            return $this->success(
                data: $projects,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getMessage(),
            );
        }
    }
}
