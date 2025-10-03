<?php

namespace App\Containers\Tasks\Transporters;

use App\Containers\Tasks\Enums\Stage;
use App\Ship\Parents\Transporters\Transporter;
use Illuminate\Support\Carbon;

final class CreateTaskTransporter extends Transporter
{
    public function __construct(
        public readonly int $userId,
        public readonly string $title,
        public readonly string $description,
        public readonly Stage $stage,
        public readonly Carbon $deadline,
        public readonly ?int $parentId,
        public readonly ?int $projectId,
    ) {
        //
    }
}
