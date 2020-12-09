<?php

declare(strict_types=1);

namespace App\Domain\Course\Model;

class StudyCourse extends AbstractCourse
{
    private string $curriculum;

    public function __construct()
    {
        parent::__construct();
        $this->curriculum = '';
    }

    public function getCurriculum(): string
    {
        return $this->curriculum;
    }

    public function setCurriculum(string $curriculum): void
    {
        $this->curriculum = $curriculum;
    }
}
