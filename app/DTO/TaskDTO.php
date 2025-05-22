<?php

namespace App\DTO;

use Illuminate\Http\Request;
use App\DTO\Helpers\TaskHelper;

class TaskDTO
{
    public const KEYS_INDEX = [
        'userId',
        'startTimestamp',
        'endTimestamp'
    ];

    public const KEYS_STORE = [
        'userId',
        'title',
        'description',
        'taskStatus',
        'deadline'
    ];

    public const KEYS_UPDATE = [
        'id',
        'userId',
        'title',
        'description',
        'taskStatus',
        'deadline'
    ];

    public const KEYS_DELETE = [
        'id',
        'userId'
    ];

    public int $id;
    public int $userId;
    public string $title;
    public string $description;
    public string $taskStatus;
    public int $deadline;
    public int $start;
    public int $end;

    public function fromIndexRequest(Request $request): void
    {
        $helper = new TaskHelper();
        $helper->assignParameters(
            $this,
            $request,
            self::KEYS_INDEX
        );
    }

    public function fromStoreRequest(Request $request): void
    {
        $helper = new TaskHelper();
        $helper->assignParameters(
            $this,
            $request,
            self::KEYS_STORE
        );
    }

    public function fromUpdateRequest(Request $request): void
    {
        $helper = new TaskHelper();
        $helper->assignParameters(
            $this,
            $request,
            self::KEYS_UPDATE
        );
    }

    public function fromDeleteRequest(Request $request): void
    {
        $helper = new TaskHelper();
        $helper->assignParameters(
            $this,
            $request,
            self::KEYS_DELETE
        );
    }
}
