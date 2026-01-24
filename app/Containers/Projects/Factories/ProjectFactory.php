<?php

namespace App\Containers\Projects\Factories;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Values\DescriptionValue;
use App\Containers\Projects\Values\TitleValue;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'title'       => $this->faker->text(TitleValue::MAX_LENGTH),
            'description' => $this->faker->text(DescriptionValue::MAX_LENGTH),
        ];
    }
}
