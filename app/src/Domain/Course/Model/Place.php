<?php

declare(strict_types=1);

namespace App\Domain\Course\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Place
{
    private UuidInterface $id;

    private string $name;

    private ?string $coordinates;

    private ?string $link;

    /** @var Collection<null, Course|null> */
    private Collection $courses;

    public function __construct()
    {
        $this->id          = Uuid::uuid4();
        $this->name        = '';
        $this->coordinates = null;
        $this->link        = null;
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

    public function getCoordinates(): ?string
    {
        return isset($this->coordinates) ? $this->coordinates : null;
    }

    public function setCoordinates(string $coordinates): void
    {
        $this->coordinates = $coordinates;
    }

    public function getLink(): ?string
    {
        return isset($this->link) ? $this->link : null;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return Collection<null, Course|null>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): void
    {
        $this->courses->add($course);
    }

    public function removeCourse(Course $course): void
    {
        $this->courses->removeElement($course);
    }
}
