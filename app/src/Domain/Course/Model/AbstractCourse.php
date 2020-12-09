<?php

declare(strict_types=1);

namespace App\Domain\Course\Model;

use App\Domain\Project\Model\Project;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class AbstractCourse
{
    protected UuidInterface $id;

    protected string $name;

    /** @var Collection<null, Place|null> */
    protected Collection $places;

    protected string $description;

    /** @var Collection<null, Project|null> */
    protected Collection $projects;

    protected ?\DateTimeInterface $beginDate;

    protected \DateTimeInterface $endDate;

    public function __construct()
    {
        $this->id          = Uuid::uuid4();
        $this->name        = '';
        $this->places      = new ArrayCollection();
        $this->description = '';
        $this->projects    = new ArrayCollection();
        $this->beginDate   = null;
        $this->endDate     = new \DateTimeImmutable();
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
     * @return Collection<null, Place|null>
     */
    public function getPlaces(): Collection
    {
        return $this->places;
    }

    public function addPlace(Place $place): void
    {
        $this->places->add($place);
    }

    public function removePlace(Place $place): void
    {
        $this->places->removeElement($place);
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
     * @return Collection<null, Project|null>
     */
    public function getProjects(): Collection
    {
        return isset($this->projects) ? $this->projects : new ArrayCollection();
    }

    public function addProject(Project $project): void
    {
        $this->projects->add($project);
    }

    public function removeProject(Project $project): void
    {
        $this->projects->removeElement($project);
    }

    public function getBeginDate(): ?\DateTimeInterface
    {
        return isset($this->beginDate) ? $this->beginDate : null;
    }

    public function setBeginDate(?\DateTimeInterface $beginDate): void
    {
        $this->beginDate = $beginDate;
    }

    public function getEndDate(): \DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }
}
