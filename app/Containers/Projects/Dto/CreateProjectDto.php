<?php

namespace App\Containers\Projects\Dto;

use App\Containers\Projects\Values\DescriptionValue;
use App\Containers\Projects\Values\TitleValue;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Dto\Dto;

final readonly class CreateProjectDto extends Dto
{
    public function __construct(
        private readonly User $user,
        private readonly TitleValue $title,
        private readonly ?DescriptionValue $description = null,
    ) {
        //
    }

    public function userUuid(): string
    {
        return $this->user->uuid;
    }

    public function title(): string
    {
        return $this->title->value();
    }

    public function description(): ?string
    {
        return $this->description?->value();
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
        );
    }
}
