<?php

declare(strict_types=1);

namespace App\Domain\Course\Model;

class Course extends AbstractCourse
{
    private string $type;

    public function __construct()
    {
        parent::__construct();
        $this->type = '';
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
