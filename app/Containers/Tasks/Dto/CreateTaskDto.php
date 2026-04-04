<?php

namespace App\Containers\Tasks\Dto;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Repositories\ProjectRepository;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Containers\Tasks\Values\DescriptionValue;
use App\Containers\Tasks\Values\StageValue;
use App\Containers\Tasks\Values\TitleValue;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Dto\Dto;

final readonly class CreateTaskDto extends Dto
{
    public function __construct(
        public readonly User $user,
        public readonly TitleValue $title,
        public readonly StageValue $stage,
        public readonly ?DescriptionValue $description = null,
        public readonly ?DeadlineValue $deadline = null,
        public readonly ?Project $project = null,
    ) {
        //
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            user: $inputData['user'],
            title: TitleValue::from(
                string: $inputData['title'],
            ),
            description: DescriptionValue::fromNullable(
                input: $inputData['description'],
            ),
            stage: StageValue::from(
                string: $inputData['stage'],
            ),
            deadline: DeadlineValue::fromNullable(
                value: $inputData['deadline'],
            ),
            project: ProjectRepository::byNullableUuid(
                uuid: $inputData['project_uuid'],
            ),
        );
    }
}
