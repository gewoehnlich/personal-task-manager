<?php

namespace App\DTO;

use Illuminate\Http\Request;
use App\DTO\Helpers\TaskHelper;

class TaskDTO
{
    private const KEYS_INDEX  = ['userId', 'start', 'end'];
    private const KEYS_STORE  = ['userId', 'title', 'description', 'taskStatus', 'deadline'];
    private const KEYS_UPDATE = ['id', 'userId', 'title', 'description', 'taskStatus', 'deadline'];
    private const KEYS_DELETE = ['id', 'userId'];

    public int    $id;
    public int    $userId;
    public string $title;
    public string $text;
    public string $taskStatus;
    public int    $deadline;
    public int    $start;
    public int    $end;

    public function fromIndexRequest(Request $request): void
    {
        $helper = (new TaskHelper())
            ->assignParameters(
                $this,
                $request,
                self::KEYS_INDEX
            );

        /*if (!is_null($request->input('user_id'))) {*/
        /*    $this->userId = $request->input('user_id');*/
        /*}*/
        /**/
        /*if (!is_null($request->input('start'))) {*/
        /*    $this->start = $request->input('start');*/
        /*}*/
        /**/
        /*if (!is_null($request->input('end'))) {*/
        /*    $this->end = $request->input('end');*/
        /*}*/
    }

    public function fromStoreRequest(Request $request): void
    {
        $helper = (new TaskHelper())
            ->assignParameters(
                $this,
                $request,
                self::KEYS_STORE
            );

        /*if (!is_null($request->input('user_id'))) {*/
        /*    $this->userId = $request->input('user_id');*/
        /*}*/
        /**/
        /*if (!is_null($request->input('title'))) {*/
        /*    $this->title = $request->input('title');*/
        /*}*/
        /**/
        /*if (!is_null($request->input('description'))) {*/
        /*    $this->description = $request->input('text');*/
        /*}*/
        /**/
        /*if (!is_null($request->input('task_status'))) {*/
        /*    $this->taskStatus = $request->input('task_status');*/
        /*}*/
        /**/
        /*if (!is_null($request->input('deadline'))) {*/
        /*    $this->deadline = $request->input('deadline');*/
        /*}*/
    }

    public function fromUpdateRequest(Request $request): void
    {
        $helper = (new TaskHelper())
            ->assignParameters(
                $this,
                $request,
                self::KEYS_UPDATE
            );

        /*if (!is_null($request->input('id'))) {*/
        /*    $this->id = $request->input('id');*/
        /*}*/
        /**/
        /*if (!is_null($request->input('user_id'))) {*/
        /*    $this->userId = $request->input('user_id');*/
        /*}*/
        /**/
        /*if (!is_null($request->input('title'))) {*/
        /*    $this->title = $request->input('title');*/
        /*}*/
        /**/
        /*if (!is_null($request->input('description'))) {*/
        /*    $this->description = $request->input('description');*/
        /*}*/
        /**/
        /*if (!is_null($request->input('task_status'))) {*/
        /*    $this->taskStatus = $request->input('task_status');*/
        /*}*/
        /**/
        /*if (!is_null($request->input('deadline'))) {*/
        /*    $this->deadline = $request->input('deadline');*/
        /*}*/
    }

    public function fromDeleteRequest(Request $request): void
    {
        $helper = (new TaskHelper())
            ->assignParameters(
                $this,
                $request,
                self::KEYS_DELETE
            );

        /*if (!is_null($request->input('id'))) {*/
        /*    $this->id = $request->input('id');*/
        /*}*/
        /**/
        /*if (!is_null($request->input('user_id'))) {*/
        /*    $this->userId = $request->input('user_id');*/
        /*}*/
    }
}
