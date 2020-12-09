<?php

declare(strict_types=1);

namespace App\Domain\Resource\Model;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Resource
{
    private UuidInterface $id;

    private string $name;

    private Type $type;

    private string $description;

    private string $link;

    public function __construct()
    {
        $this->id          = Uuid::uuid4();
        $this->description = '';
        $this->link        = '';
        $this->name        = '';
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

    public function getType(): ?Type
    {
        return isset($this->type) ? $this->type : null;
    }

    public function setType(Type $type): void
    {
        $this->type = $type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }
}
