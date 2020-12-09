<?php

declare(strict_types=1);

namespace App\Domain\Experience\Model;

use App\Domain\Project\Model\Project;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Experience
{
    private UuidInterface $id;

    private ?Type $type;

    private string $name;

    private string $level;

    /** @var Collection<null, KeyPoint|null> */
    private Collection $keyPoints;

    /** @var Collection<null, Project|null> */
    private Collection $projects;

    public function __construct()
    {
        $this->id        = Uuid::uuid4();
        $this->name      = '';
        $this->level     = '';
        $this->keyPoints = new ArrayCollection();
        $this->projects  = new ArrayCollection();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getType(): ?Type
    {
        return isset($this->type) ? $this->type : null;
    }

    public function setType(Type $type): void
    {
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    /**
     * @return Collection<null, KeyPoint|null>
     */
    public function getKeyPoints(): Collection
    {
        return $this->keyPoints;
    }

    public function addKeyPoint(KeyPoint $keyPoint): void
    {
        if ($this->keyPoints->contains($keyPoint)) {
            return;
        }
        $keyPoint->addExperience($this);
        $this->keyPoints->add($keyPoint);
    }

    public function removeKeyPoint(KeyPoint $keyPoint): void
    {
        if (!$this->keyPoints->contains($keyPoint)) {
            return;
        }
        $this->keyPoints->removeElement($keyPoint);
    }

    /**
     * @return Collection<null, Project|null>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): void
    {
        $this->projects->add($project);
    }

    public function removeProject(Project $project): void
    {
        $this->projects->removeElement($project);
    }
}
