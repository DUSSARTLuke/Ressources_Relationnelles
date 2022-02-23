<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "get"={"normalization_context"={"groups"="user:collection:read"}},
 *          "post"
 *     },
 *     itemOperations={
 *         "get","put", "delete"
 *     },
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}}
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read", "user:collection:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user:read", "user:write", "user:collection:read", "resource:read", "resource:collection:read", "comment:read", "favorite:read"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({"user:read", "user:write", "user:collection:read"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Groups({"user:read", "user:write", "user:collection:read"})
     */
    private $address1 = null;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Groups({"user:read", "user:write", "user:collection:read"})
     */
    private $address2 = null;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     * @Groups({"user:read", "user:write", "user:collection:read"})
     */
    private $postalCode = null;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"user:read", "user:write", "user:collection:read"})
     */
    private $city = null;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"user:read", "user:write", "user:collection:read"})
     *
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "example"="18/11/2021"
     *         }
     *     }
     * )
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Groups({"user:read", "user:write", "user:collection:read"})
     */
    private $socialSituation = null;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"user:read", "user:write"})
     */
    private $password;

    /**
     * @var string The hashed confirmation of password
     * @ORM\Column(type="string")
     * @Groups({"user:read", "user:write"})
     */
    private $confPassword;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @Groups({"user:read", "user:collection:read"})
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
     * @ORM\Column(type="boolean")
     * @Groups({"user:read", "user:write", "user:collection:read"})
     *
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "example"= false
     *         }
     *     }
     * )
     */
    private $isActive = 0;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="user")
     * @Groups({"user:read"})
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Favorite::class, mappedBy="user")
     * @Groups({"user:read"})
     */
    private $favorites;

    /**
     * @ORM\OneToMany(targetEntity=Progress::class, mappedBy="user")
     * @Groups({"user:read"})
     */
    private $progress;

    /**
     * @ORM\OneToMany(targetEntity=Resource::class, mappedBy="createdBy")
     * @Groups({"user:read"})
     */
    private $createdResources;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @Groups({"user:read", "user:write", "user:collection:read"})
     *
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "example"= false
     *         }
     *     }
     * )
     */
    private $isRGPD;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->progress = new ArrayCollection();
        $this->createdResources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getBirthday(): ?\DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getSocialSituation(): ?string
    {
        return $this->socialSituation;
    }

    public function setSocialSituation(?string $socialSituation): self
    {
        $this->socialSituation = $socialSituation;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

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
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Favorite[]
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorite $favorite): self
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites[] = $favorite;
            $favorite->setUser($this);
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): self
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getUser() === $this) {
                $favorite->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Progress[]
     */
    public function getProgress(): Collection
    {
        return $this->progress;
    }

    public function addProgress(Progress $progress): self
    {
        if (!$this->progress->contains($progress)) {
            $this->progress[] = $progress;
            $progress->setUser($this);
        }

        return $this;
    }

    public function removeProgress(Progress $progress): self
    {
        if ($this->progress->removeElement($progress)) {
            // set the owning side to null (unless already changed)
            if ($progress->getUser() === $this) {
                $progress->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Resource[]
     */
    public function getCreatedResources(): Collection
    {
        return $this->createdResources;
    }

    public function addCreatedResource(Resource $createdResource): self
    {
        if (!$this->createdResources->contains($createdResource)) {
            $this->createdResources[] = $createdResource;
            $createdResource->setCreatedBy($this);
        }

        return $this;
    }

    public function removeCreatedResource(Resource $createdResource): self
    {
        if ($this->createdResources->removeElement($createdResource)) {
            // set the owning side to null (unless already changed)
            if ($createdResource->getCreatedBy() === $this) {
                $createdResource->setCreatedBy(null);
            }
        }

        return $this;
    }

    public function getIsRGPD(): ?bool
    {
        return $this->isRGPD;
    }

    public function setIsRGPD(bool $isRGPD): self
    {
        $this->isRGPD = $isRGPD;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;

    }

    /**
     * @return string
     */
    public function getConfPassword(): string
    {
        return $this->confPassword;
    }


    public function setConfPassword(string $confPassword): self
    {
        $this->confPassword = $confPassword;

        return $this;
    }
}
