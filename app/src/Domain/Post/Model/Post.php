<?php

declare(strict_types=1);

namespace App\Domain\Post\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Post
{
    private UuidInterface $id;

    private string $title;

    private string $subTitle;

    private string $content;

    private string $vignette;

    /** @var Collection<null, Tag|null> */
    private Collection $tags;

    public function __construct()
    {
        $this->id          = Uuid::uuid4();
        $this->title       = '';
        $this->subTitle    = '';
        $this->content     = '';
        $this->vignette    = '';
        $this->tags        = new ArrayCollection();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSubTitle(): string
    {
        return $this->subTitle;
    }

    public function setSubTitle(string $subTitle): void
    {
        $this->subTitle = $subTitle;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getVignette(): string
    {
        return $this->vignette;
    }

    public function setVignette(string $vignette): void
    {
        $this->vignette = $vignette;
    }

    /**
     * @return Collection<null, Tag|null>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): void
    {
        $this->tags->add($tag);
    }

    public function removeTag(Tag $tag): void
    {
        $this->tags->removeElement($tag);
    }
}
