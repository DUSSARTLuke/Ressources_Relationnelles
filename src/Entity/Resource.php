<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\DBAL\Types\ResourceType;
use App\DBAL\Types\ResourceVisibilityType;
use App\Repository\ResourceRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\DBAL\Types\ResourceStatusType;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ResourceRepository::class)
 */
class Resource
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(name="status", type="ResourceStatusType", nullable=false)
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\ResourceStatusType")
     */
    private $status = ResourceStatusType::WAITING_VALIDATION;

    /**
     * @ORM\Column(name="visibility", type="ResourceVisibilityType", nullable=false)
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\ResourceVisibilityType")
     */
    private $visibility = ResourceVisibilityType::PUBLIC;


    /**
     * @ORM\Column(name="resource_type", type="ResourceType", nullable=false)
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\ResourceType")
     */
    private $resourceType;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="resources")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=RelationType::class, inversedBy="resources")
     */
    private $relationType;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="resource")
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="createdResources")
     * @ORM\JoinColumn(name="created_by", nullable=false)
     */
    private $createdBy;

    public function __construct()
    {
        $this->relationType = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
        return ResourceStatusType::getReadableValue($this->status);
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getResourceType(): ?string
    {
        if ($this->resourceType != null) {
            return ResourceType::getReadableValue($this->resourceType);
        } else {
            return '';
        }
    }

    public function setResourceType(string $resourceType): self
    {
        $this->resourceType = $resourceType;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt->format('d/m/Y H:i:s');
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|RelationType[]
     */
    public function getRelationType(): Collection
    {
        return $this->relationType;
    }

    public function addRelationType(RelationType $relationType): self
    {
        if (!$this->relationType->contains($relationType)) {
            $this->relationType[] = $relationType;
        }

        return $this;
    }

    public function removeRelationType(RelationType $relationType): self
    {
        $this->relationType->removeElement($relationType);

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setResource($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getResource() === $this) {
                $comment->setResource(null);
            }
        }

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return string
     */
    public function getVisibility(): string
    {
        return ResourceVisibilityType::getReadableValue($this->visibility);
    }

    /**
     * @param string $visibility
     */
    public function setVisibility(string $visibility): self
    {
        $this->visibility = $visibility;
        return $this;

    }
}
