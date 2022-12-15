<?php

namespace App\Entities;

use App\Enums\CourseStatus;
use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[HasLifecycleCallbacks]
#[Table(name: 'courses')]
class Course
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private int|null $id = null;

    #[Column(type: 'string', nullable: true)]
    private string|null $title = null;

    #[Column(type: 'text', nullable: true)]
    private string|null $description = null;

    #[Column(type: 'string', nullable: true, enumType: CourseStatus::class)]
    private CourseStatus|null $status = null;

    #[Column(type: 'boolean')]
    private bool $isPremium = false;

    #[Column(type: 'datetime', nullable: true)]
    private DateTime|null $createdAt = null;

    #[Column(type: 'datetime', nullable: true)]
    private DateTime|null $deletedAt = null;

    /**
     * @param string|null $title
     * @param string|null $description
     * @param CourseStatus|null $status
     * @param bool $isPremium
     */
    public function __construct(
        ?string       $title = null,
        ?string       $description = null,
        ?CourseStatus $status = null,
        bool          $isPremium = false
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->isPremium = $isPremium;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return CourseStatus|null
     */
    public function getStatus(): ?CourseStatus
    {
        return $this->status;
    }

    /**
     * @param CourseStatus|null $status
     */
    public function setStatus(?CourseStatus $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isPremium(): bool
    {
        return $this->isPremium;
    }

    /**
     * @param bool $isPremium
     */
    public function setIsPremium(bool $isPremium): void
    {
        $this->isPremium = $isPremium;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTime|null $deletedAt
     */
    public function setDeletedAt(DateTime|null $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return void
     */
    #[PrePersist]
    public function beforePersist(): void
    {
        $this->createdAt = new DateTime();
    }
}
