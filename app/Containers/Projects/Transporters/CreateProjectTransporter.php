<?php

namespace App\Containers\Projects\Transporters;

use App\Containers\Projects\Values\DescriptionValue;
use App\Containers\Projects\Values\TitleValue;
use App\Containers\Users\Values\UserUuidValue;
use App\Ship\Abstracts\Transporters\Transporter;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final readonly class CreateProjectTransporter extends Transporter
{
    public function __construct(
        public readonly UserUuidValue $userUuid,
        public readonly TitleValue $title,
        public readonly ?DescriptionValue $description = null,
    ) {
        //
    }

    public static function from(
        array $data,
    ): self {
        return new self(
            userUuid: new UserUuidValue(uuid: $data['user_uuid']),
            title: new TitleValue(string: $data['title']),
            description: new DescriptionValue(string: $data['description']) ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'user_uuid'   => $this->userUuid->uuid,
            'title'       => $this->title->string,
            'description' => $this->description->string,
        ];
    }
}
