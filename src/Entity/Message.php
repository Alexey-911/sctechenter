<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[Entity(repositoryClass: MessageRepository::class)]
#[Index(columns: ["to_user_id", "from_user_id"], name: "users_idx")]
#[HasLifecycleCallbacks]
class Message
{
    #[Id]
    #[Column(type: "uuid", unique: true)]
    #[GeneratedValue(strategy: "CUSTOM")]
    #[CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id = null;

    #[ManyToOne(targetEntity: User::class)]
    #[JoinColumn(name: "from_user_id", referencedColumnName: "id")]
    private User $fromUser;

    #[ManyToOne(targetEntity: User::class)]
    #[JoinColumn(name: "to_user_id", referencedColumnName: "id")]
    private User $toUser;

    #[Column(type: "text")]
    private string $content;

    #[Column(type: "datetime")]
    private ?\DateTime $createdAt;

    #[Column(type: "datetime", nullable: true)]
    private ?\DateTime $updatedAt;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getFromUser(): User
    {
        return $this->fromUser;
    }

    public function setFromUser(User $fromUser): void
    {
        $this->fromUser = $fromUser;
    }

    public function getToUser(): User
    {
        return $this->toUser;
    }

    public function setToUser(User $toUser): void
    {
        $this->toUser = $toUser;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    #[PrePersist]
    public function prePersist(): void
    {
        $this->createdAt = new \DateTime();
    }

    #[PreUpdate]
    public function preUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }
}