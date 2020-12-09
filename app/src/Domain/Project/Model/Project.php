<?php

declare(strict_types=1);

namespace App\Domain\Project\Model;

use App\Domain\Course\Model\AbstractCourse;
use App\Domain\Course\Model\Course;
use App\Domain\Experience\Model\Experience;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Project
{
    private UuidInterface $id;

    private string $name;

    /** @var Collection<null, Experience|null> */
    private Collection $experiences;

    private string $description;

    /** @var Collection<null, Course|AbstractCourse|null> */
    private Collection $courses;

    public function __construct()
    {
        $this->id          = Uuid::uuid4();
        $this->name        = '';
        $this->experiences = new ArrayCollection();
        $this->description = '';
        $this->courses     = new ArrayCollection();
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Collection<null, Course|AbstractCourse|null>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(AbstractCourse $course): void
    {
        $this->courses->add($course);
    }

    public function removeCourse(AbstractCourse $course): void
    {
        $this->courses->removeElement($course);
    }
}
