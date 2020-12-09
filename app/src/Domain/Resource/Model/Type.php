<?php

declare(strict_types=1);

namespace App\Domain\Resource\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Type
{
    private UuidInterface $id;

    private string $name;

    private string $description;

    /** @var Collection<null, \App\Domain\Resource\Model\Resource|null> */
    private Collection $resources;

    public function __construct()
    {
        $this->id          = Uuid::uuid4();
        $this->name        = '';
        $this->description = '';
        $this->resources   = new ArrayCollection();
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Collection<null, \App\Domain\Resource\Model\Resource|null>
     */
    public function getResources(): Collection
    {
        return $this->resources;
    }

    public function addResource(Resource $resource): void
    {
        $this->resources->add($resource);
    }

    public function removeResource(Resource $resource): void
    {
        $this->resources->removeElement($resource);
    }
}
