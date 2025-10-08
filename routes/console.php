<?php

use App\Ship\Actions\RoutesContainersRegisterAction;

(new RoutesContainersRegisterAction())->run(
    channel: 'console',
);
