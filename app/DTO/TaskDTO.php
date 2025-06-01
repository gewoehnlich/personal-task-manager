<?php

namespace App\DTO;

use App\Http\Requests\Api\Tasks\TaskRequest;
use App\Enums\TaskStatus;
use Illuminate\Support\Facades\Auth;

abstract class TaskDTO
{
    private const array FIELDS = [];
    private const array FIELD_METHODS = [
        'id'           =>  'setId',
        'userId'       =>  'setUserId',
        'title'        =>  'setTitle',
        'description'  =>  'setDescription',
        'taskStatus'   =>  'setTaskStatus',
        'deadline'     =>  'setDeadline',
        'start'        =>  'setStart',
        'end'          =>  'setEnd'
    ];

    public static function fromRequest(
        TaskRequest $request
    ): TaskDTO {
        return (new static())->assignProperties(
            $request,
            static::FIELDS
        );
    }

    private function assignProperties(
        TaskRequest $request,
        array $fields
    ): TaskDTO {
        foreach ($fields as $key) {
            $method = self::FIELD_METHODS[$key];
            $this->{$method}($request);
        }

        return $this;
    }

    private function setId(
        TaskRequest $request
    ): void {
        $this->id = $request->integer('id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    private function setUserId(
        TaskRequest $request
    ): void {
        $this->userId = Auth::id();
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    private function setTitle(
        TaskRequest $request
    ): void {
        $this->title = $request->string('title')->trim();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    private function setDescription(
        TaskRequest $request
    ): void {
        $this->description = $request->string('description')->trim();
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    private function setTaskStatus(
        TaskRequest $request
    ): void {
        $this->taskStatus = $request->enum('taskStatus', TaskStatus::class);
    }

    public function getTaskStatus(): string
    {
        return $this->taskStatus;
    }

    private function setDeadline(
        TaskRequest $request
    ): void {
        $this->deadline = $request->date('deadline');
    }

    public function getDeadline(): string
    {
        return $this->deadline;
    }

    private function setStart(
        TaskRequest $request
    ): void {
        $this->start = $request->date('start');
    }

    public function getStart(): string
    {
        return $this->start;
    }

    private function setEnd(
        TaskRequest $request
    ): void {
        $this->end = $request->date('end');
    }

    public function getEnd(): string
    {
        return $this->end;
    }
}
