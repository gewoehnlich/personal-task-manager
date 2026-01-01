<?php

namespace App\Ship\Contracts;

use App\Ship\Abstracts\Transporters\Transporter;

interface Transportable
{
    public function transporter(): string;

    public function transported(): Transporter;
}
