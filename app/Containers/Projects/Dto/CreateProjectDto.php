<?php

namespace App\Containers\Projects\Dto;

use App\Containers\Projects\Values\DescriptionValue;
use App\Containers\Projects\Values\TitleValue;
use App\Containers\Users\Values\UserUuidValue;
use App\Ship\Abstracts\Dto\Dto;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final readonly class CreateProjectDto extends Dto
{
    public function __construct(
        public readonly UserUuidValue $userUuid,
        public readonly TitleValue $title,
        public readonly ?DescriptionValue $description = null,
    ) {
        //
    }

    public function userUuid(): string
    {
        return $this->userUuid->uuid;
    }

    public function title(): string
    {
        return $this->title->string;
    }

    public function description(): ?string
    {
        return $this->description?->string;
    }

    public static function from(
        array $data,
    ): self {
        return new self(
            userUuid: new UserUuidValue(uuid: $data['user_uuid']),
            title: new TitleValue(string: $data['title']),
            description: $data['description'] === null
                ? null
                : new DescriptionValue(string: $data['description']),
        );
    }

    public function toArray(): array
    {
        return [
            'user_uuid'   => $this->userUuid->uuid,
            'title'       => $this->title->string,
            'description' => $this->description?->string,
        ];
    }
}
