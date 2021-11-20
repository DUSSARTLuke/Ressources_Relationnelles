<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use App\DBAL\Types\CommentStatusType;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "post"={
 *             "denormalization_context"={"groups"={"comment:post"}}
 *         }
 *     },
 *     itemOperations={
 *         "get", "put"={
 *             "denormalization_context"={"groups"={"comment:put"}}
 *         },
 *          "delete"
 *     },
 *     normalizationContext={"groups"={"comment:read"}},
 *     denormalizationContext={"groups"={"comment:write"}}
 * )
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"comment:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"comment:read", "comment:post", "comment:put", "user:read", "resource:read"})
     */
    private $content;

    /**
     * @ORM\Column(name="status", type="CommentStatusType", nullable=false)
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\CommentStatusType")
     * @Groups({"comment:read", "comment:put", "user:read", "resource:read"})
     *
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "example"="Créé"
     *         }
     *     }
     * )
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @Groups({"comment:read", "user:read", "resource:read"})
     *
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "example"="18/11/2021 15:00:00"
     *         }
     *     }
     * )
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     * @Groups({"comment:read", "user:read", "resource:read"})
     *
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "example"="18/11/2021 15:00:00"
     *         }
     *     }
     * )
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"comment:read", "comment:post", "resource:read"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Resource::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"comment:read", "comment:post", "user:read"})
     */
    private $resource;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getStatus(): ?string
    {
        return CommentStatusType::getReadableValue($this->status);
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt->format('d/m/Y H:i:s');
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt->format('d/m/Y H:i:s');
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getResource(): ?Resource
    {
        return $this->resource;
    }

    public function setResource(?Resource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }
}
