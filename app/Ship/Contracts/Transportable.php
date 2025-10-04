<?php

namespace App\Ship\Contracts;

use App\Ship\Parents\Transporters\Transporter;

interface Transportable
{
    public function transporter(): string;

    public function transported(): Transporter;
}
