<?php

use App\Containers\Auth\Providers\AuthServiceProvider;
use App\Containers\Bills\Providers\BillServiceProvider;
use App\Containers\Projects\Providers\ProjectServiceProvider;
use App\Containers\Settings\Providers\SettingsServiceProvider;
use App\Containers\Tasks\Providers\TaskServiceProvider;
use App\Containers\Users\Providers\UserServiceProvider;
use App\Ship\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
    AuthServiceProvider::class,
    BillServiceProvider::class,
    ProjectServiceProvider::class,
    SettingsServiceProvider::class,
    TaskServiceProvider::class,
    UserServiceProvider::class,
];
