<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\RelationTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "get"
 *     },
 *     itemOperations={
 *         "get"
 *     },
 *     normalizationContext={"groups"={"relationType:read"}}
 * )
 * @ORM\Entity(repositoryClass=RelationTypeRepository::class)
 */
class RelationType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"relationType:read", "resource:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @Groups({"relationType:read", "resource:read", "resource:collection:read"})
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Resource::class, mappedBy="relationType")
     * @ApiSubresource
     */
    private $resources;

    public function __construct()
    {
        $this->resources = new ArrayCollection();
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

    /**
     * @return Collection|Resource[]
     */
    public function getResources(): Collection
    {
        return $this->resources;
    }

    public function addResource(Resource $resource): self
    {
        if (!$this->resources->contains($resource)) {
            $this->resources[] = $resource;
        }

        return $this;
    }

    public function removeResource(Resource $resource): self
    {
        return $this;
    }
}
