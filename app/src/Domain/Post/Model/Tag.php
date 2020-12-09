<?php

declare(strict_types=1);

namespace App\Domain\Post\Model;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Tag
{
    private UuidInterface $id;

    private string $name;

    private ?string $icon;

    public function __construct()
    {
        $this->id   = Uuid::uuid4();
        $this->name = '';
        $this->icon = null;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getIcon(): ?string
    {
        return isset($this->icon) ? $this->icon : null;
    }

    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }
}
