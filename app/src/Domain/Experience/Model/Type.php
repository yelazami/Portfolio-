<?php

declare(strict_types=1);

namespace App\Domain\Experience\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Type
{
    private UuidInterface $id;

    private string $name;

    /** @var Collection<null, Experience|null> */
    private Collection $experiences;

    public function __construct()
    {
        $this->id          = Uuid::uuid4();
        $this->name        = '';
        $this->experiences = new ArrayCollection();
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

    /**
     * @return Collection<null, Experience|null>
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): void
    {
        $this->experiences->add($experience);
    }

    public function removeExperience(Experience $experience): void
    {
        $this->experiences->removeElement($experience);
    }
}
