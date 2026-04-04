<?php

namespace App\Containers\Projects\Dto;

use App\Containers\Projects\Values\DescriptionValue;
use App\Containers\Projects\Values\TitleValue;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Dto\Dto;

final readonly class CreateProjectDto extends Dto
{
    public function __construct(
        public readonly User $user,
        public readonly TitleValue $title,
        public readonly ?DescriptionValue $description = null,
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
        );
    }
}
