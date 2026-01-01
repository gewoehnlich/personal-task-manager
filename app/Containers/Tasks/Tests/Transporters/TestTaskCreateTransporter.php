<?php

namespace App\Containers\Tasks\Tests\Transporters;

use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Transporters\TaskCreateTransporter;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class TestTaskCreateTransporter extends TestCase
{
    public function testConstructorSetsPropertiesCorrectly(): void
    {
        $userId      = 1;
        $title       = 'test title';
        $description = 'test description';
        $stage       = Stage::PENDING;
        $deadline    = now()->addMonth();

        $transporter = new TaskCreateTransporter(
            userId: $userId,
            title: $title,
            description: $description,
            stage: $stage,
            deadline: $deadline,
        );

        $this->assertSame($userId, $transporter->userId);
        $this->assertSame($title, $transporter->title);
        $this->assertSame($description, $transporter->description);
        $this->assertSame($stage, $transporter->stage);
        $this->assertEquals($deadline, $transporter->deadline);
    }
}
