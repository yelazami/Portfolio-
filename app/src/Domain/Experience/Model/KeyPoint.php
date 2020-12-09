<?php

declare(strict_types=1);

namespace App\Domain\Experience\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class KeyPoint
{
    private UuidInterface $id;

    private string $text;

    /** @var Collection<null, Experience|null> */
    private Collection $experiences;

    public function __construct()
    {
        $this->id          = Uuid::uuid4();
        $this->text        = '';
        $this->experiences = new ArrayCollection();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /** @return Collection<null, Experience|null> */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): void
    {
        if ($this->experiences->contains($experience)) {
            return;
        }
        $this->experiences->add($experience);
    }

    public function removeExperience(Experience $experience): void
    {
        if (!$this->experiences->contains($experience)) {
            return;
        }
        $this->experiences->removeElement($experience);
    }
}
